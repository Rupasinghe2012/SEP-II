<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Mail;
use Hash;
use Carbon\Carbon;
use App\Http\Requests;
use App\User;
use App\Widget;
use App\ExceptionsLog;

class ProfileController extends Controller
{
    /**
     * @description This class handles all the user details
     */

    private $notification;
    private $userId;
    private $mail;

    /**
     * profileController constructor.
     */
    public function __construct()
    {
        $this->userId=Auth::user()->id;
        $this->mail=Auth::user()->email;
        $this->notification = new NotificationController();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $wd= Widget::where('user_id',Auth::user()->id)->get();
        $count = Widget::where('user_id',Auth::user()->id)->count();

        $user =User::all();
        return view('/profile' , compact('user'), compact('wd'), compact('count '));
    }



    /**
     * @param \Illuminate\Http\Request|Request $request
     * @description updating the profile details of the user
     */
    public function update(Request $request){

        //validate the information sent first
        $this->validate($request, [
            'name'=> 'required|min 8',
            'email' => 'required|email',
            'status' => 'required',
            'BOD' => 'required',
            'address' => 'required|max 255',
            'job' => 'required|max 20'
        ]);
        
        try{
        $user = User::find(Input::get('id'));

        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = $request->status;
        $user->BOD = $request->BOD;
        $user->address = $request->address;
        $user->job = $request->job;
        $user->mobile = $request->mobile;

         
             if ($user->update()) {
                 $this->notification->addNotification($this->userId,'self-profile_update');
                 return Redirect::back()
                     ->with('succes', 'Profile is updated!');
                 //Sucessfully Saved
             }
             else{
                 return http_response_code(500);//Internal Server Error
             }
         }
         catch (\Exception $exception){
             $exceptionData['user_id'] = $this->userId;
             $exceptionData['exception'] = $exception->getMessage();
             $exceptionData['time'] = Carbon::now()->toDateTimeString();

             ExceptionsLog::create($exceptionData);
         }

    }


    /**
     * @param \Illuminate\Http\Request|Request $request
     * @description Updating the social profile links of the user
     */
    public function link(Request $request){
        
        try{
        $user = User::find(Input::get('id'));

        $user->fb = $request->fb;
        $user->youtube = $request->youtube;
        $user->google = $request->google;
        $user->twiter = $request->twiter;
        $user->instagram = $request->instagram;

        
            if ($user->save()) {
                $this->notification->addNotification($this->userId,'self-Social');
                return Redirect::back()
                    ->with('message', 'Details Updated');//Sucessfully Saved
            }
            else{
                return http_response_code(500);//Internal Server Error
            }
        }
        catch (\Exception $exception){
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }

    }


    /**
     * @description Uploading the profile picture  of the user
     */
    public function picture()
    {
        try {
        $user = User::find(Input::get('id'));
        
            $image = Input::file('profile_pic');
            $filename = time() . "-" . $image->getClientOriginalExtension();
            $path = public_path('img/' . $filename);
            Image::make($image->getRealPath())->resize(222, 205)->save($path);

            $user->profile_pic = 'img/' . $filename;

            $user->save();
            $this->notification->addNotification($this->userId, 'self-proPic_change');
            return Redirect::back()
                ->with('message', 'Profile Picture Updated');
        }
        catch (\Exception $exception){
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }
    }


    /**
     * @param \Illuminate\Http\Request|Request $request
     * @description Changing the user password
     */
    public function changePwd(Request $request)
    {
        try {
        $user = User::find(Input::get('id'));

        $curPw = $request->currentp;
        $newp = $request->newp;
        $rep = $request->rep;


            // is new password charecter lenght is more than 6 ?
            if (strlen($newp) < 6) {
                return Redirect('/profile#settings')
                    ->with('wmessage', 'Enter a Password with more than 6 characters!');
            } // is  current password field value is equal to current passwoord and new passowrd equal to re typed passweod
            else if (Hash::check($curPw, $user->password) && $newp == $rep) {
                $newp = bcrypt($newp);
                $user->password = $newp;
                $user->save();

                //send mail to the relevant user on password update
                $this->mailMethod('mail.password');

                $this->notification->addNotification($this->userId, 'self-password_change');
                return Redirect('/profile#changePwd')
                    ->with('pwmessage', 'Password Updated!');
            } // is current password field value is equal to current password
            else if (!Hash::check($curPw, $user->password)) {
                return Redirect('/profile#changePwd')
                    ->with('wmessage', 'Incorrect Password!');
            } // is current password field value is equal to current password and is it not equal the new password and retyped passwrod
            else if (Hash::check($curPw, $user->password) && $newp != $rep) {
                return Redirect('/profile#changePwd')
                    ->with('wmessage', 'Type The New Password Again!');
            }
        }
        catch (\Exception $exception){
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }

    }



    /**
     * @param \Illuminate\Http\Request|Request $request
     * @description Adding the twitter accoutn  widget of the user
     */
    public function widget(Request $request){
        try {
        $user = User::find(Input::get('id'));
        
            $wd = $user->widget()->create([
                'user_id' => Auth::user()->id,
                'code' => $request->input('code'),

            ]);
            return Redirect::back();
        }
        catch (\Exception $exception){
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }
    }

    /**
     * @param $path
     * @description sending mail to the logged in user upon profile &/ password update
     */
    private function mailMethod($path) {
        $data = array(
            'name' => Auth::user()->name,
        );

        Mail::send($path, $data, function($message) {
            $message->from('azinabcoc@gmail.com', 'Profiler.NET');
            $message->to($this->mail)->subject('Profile Update');
        });
    }


}
