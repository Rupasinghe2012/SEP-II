<?php
namespace App\Http\Controllers;

use App\ExceptionsLog;
use App\LoginLog;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
//use Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

/**
 * Class CustomAuthenticationController
 * @description This controller will handle authentication for the whole system
 * @package App\Http\Controllers
 */
class CustomAuthenticationController extends Controller
{
    private $clientLoginRedirect = "/client";
    private $adminLoginRedirect = "/admin";
    private $logoutRedirect = "/auth/login";

    /**
     * @description returns the login page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show() {
        //check if the user is logged in already
        if(Auth::user() == null) {
            return view('auth.login');
        }
        else {
            $this->logoutUser();
        }
    }

    /**
     * @description handler for login. returns login result
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function loginUser(Request $request) {
        //validate the information sent first
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        try {
            //if credentials are valid then try authentication
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {

                //user has been authenticated successfully
                //redirect to relevant page
                if(Auth::user()->type == "client") {
                    $this->addToLogLogin();
                    return redirect($this->clientLoginRedirect);
                }
                else if(Auth::user()->type == "admin") {
                    $this->addToLogLogin();
                    return redirect($this->adminLoginRedirect);
                }
                else {
                    //appropriate user type was not found in the database
                    return redirect($this->logoutRedirect)
                        ->with('error', 'Your credentials were invalid.');
                }
            }
            else {
                return redirect($this->logoutRedirect)
                    ->with('error', 'Your credentials were invalid.');
            }
        } catch(\Exception $exception){
            $exceptionData['user_id'] = Auth::user()->id;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);

            return redirect($this->logoutRedirect)
                ->with('error', 'A system error occurred.');
        }
    }

    /**
     * @description handler to logout user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logoutUser() {
        try {
            $this->addToLogLogout();
            Auth::logout();
            Session::flush();
            return redirect('/auth/login')
                ->with('message', 'You have been successfully logged out. Have a nice day!');
        } catch(\Exception $exception){
            $exceptionData['user_id'] = Auth::user()->id;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);

            return redirect('/auth/login')
                ->with('error', 'A system error occurred.');
        }
    }

    /**
     * @description function to add login information to log
     */
    public function addToLogLogin() {
        try {
            $userId = Auth::user()->id;
            $token = Auth::user()->remember_token;

            LoginLog::create([
                'user_id' => $userId,
                'token' => $token,
                'logged_in_datetime' => Carbon::now()
            ]);
        } catch(\Exception $exception){
            $exceptionData['user_id'] = Auth::user()->id;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);

            return redirect('/auth/login')
                ->with('error', 'A system error occurred.');
        }
    }

    /**
     * @description function to add logout information to log
     */
    public function addToLogLogout() {
        try {
            $logEntry = LoginLog::where('token', Auth::user()->remember_token)->first();
            $logEntry->logged_out_datetime = Carbon::now();

            $logEntry->save();
        } catch(\Exception $exception){
            $exceptionData['user_id'] = Auth::user()->id;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);

            return redirect('/auth/login')
                ->with('error', 'A system error occurred.');
        }
    }

    /**
     * @description function to reset password
     */
    public function passwordReset(Request $request) {

        //validate email address
        $this->validate($request, [
            'email' => 'required',
        ]);

        try {
            if($user = User::where('email', $request->email)->first()) {
                $newPassword = str_random(6);
                //dd($newPassword);
                $user->password = bcrypt($newPassword);
                error_log($user);
                if ($user->save()) {
                    $data = array(
                        'name' => $user->name,
                        'time' => Carbon::now(),
                        'password' => $newPassword
                    );

                    error_log('success');

                    return view('auth.reset-pass')
                        ->with('message', 'Your password was reset successfully. Please check your email. ');
                } else {
                    error_log('else error..');
                    return view('auth.reset-pass')
                        ->with('error', 'There was a database error resetting your password.');
                }
            }
            else {
                error_log('user not found..');
                //user with that email was not found
                return view('auth.reset-pass', compact(
                    ['error' => 'There is no user in the system with that email address.']
                ));
            }
        } catch(\Exception $exception){
//            $exceptionData['user_id'] = Auth::user()->id;
//            $exceptionData['exception'] = $exception->getMessage();
//            $exceptionData['time'] = Carbon::now()->toDateTimeString();
//
//            ExceptionsLog::create($exceptionData);
            error_log($exception);
            return view('auth.reset-pass')
                ->with('message', 'An internal error has occured.');
        }

    }

    /**
     * @description function to pass in reset password view
     */
    public function resetPasswordView() {
        return view('auth.reset-pass');
    }
}
