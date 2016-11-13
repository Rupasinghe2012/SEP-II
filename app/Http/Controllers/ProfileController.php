<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use App\Http\Requests;
use App\ExceptionsLog;
use Carbon\Carbon;
use App\User;
use App\Widget;


/**
 * Class ProfileController
 * @package App\Http\Controllers
 * @description handling logged in user profile
 */
class ProfileController extends Controller
{
    //logged in users email, user id should be assigned
    private $user;
    private $userId;
    //NotificationController implementation
    private $notification;

    /**
     * @param NotificationController $notificationController
     * @description assigning user id, user email
     */
    public function __construct(NotificationController $notificationController)
    {
        $this->user = Auth::user()->email;
        $this->userId = Auth::user()->id;
        $this->notification = $notificationController;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     * @description displaying profile of the looged in user
     */
    public function index($id) {
        if($this->userId == $id) {
            //logged in users details
            $userDetails = $this->getUserDetails($id);
            $type = Auth::user()->type;
            $wd= Widget::where('user_id',Auth::user()->id)->get();
            $count = Widget::where('user_id',Auth::user()->id)->count();
            return view('profile.index', compact('userDetails', 'type','wd','count'));
        } else {
            return abort(403, 'Requested User Profile is not allowed to access');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     * @description displaying profile edit view to the logged in user
     */
    public function edit($id) {
        if($this->userId == $id) {
            //logged in users details
            $userDetails = $this->getUserDetails($id);
            $type = Auth::user()->type;
            return view('profile.edit', compact('userDetails', 'type'));
        } else {
            return abort(403, 'Requested User Profile is not allowed to access');
        }
    }

    /**
     * @param $id
     * @return string
     * @description updating profile details
     */
    public function update($id) {
        //get updated data through AJAX
        $request = Input::all();
        try{
            //update users table
            DB::table('users')
                ->where('id', $id)
                ->update(['name' => $request['name'],
                    'BOD' => $request['BOD'],
                    'job'=> $request['job'],
                    'address' => $request['address'],
                    'mobile' => $request['mobile']
                ]);
            $this->notification->addNotification($this->userId,'self-profile_update');

        } catch (\Exception $exception) {
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }

        return 'Your profile has been successfully updated!';
    }

    /**
     * @param $id
     * @return string
     * @description updating password details
     */
    public function updatePass($id) {
        //get updated data through AJAX
        $request = Input::all();
        try{
            //get current password
            $password = DB::table('users')
                ->select('users.password')
                ->where('id', $id)
                ->get();

            //check current password in DB with entered current password
            if(Hash::check($request['password'], $password[0]->password)) {
                $newPassword = bcrypt($request['newPassword']);
                //update users table with new password
                DB::table('users')
                    ->where('id', $id)
                    ->update(['password' => $newPassword]);

                //send mail to the relevant user on password update
                $this->mailMethod('mail.password');
                //insert notification on password update
                $this->notification->addNotification($this->userId, 'self-password_change');

                return 'true';
            } else {
                return 'false';
            }
        } catch (\Exception $exception) {
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }
    }


    /**
     * @param $id
     * @return null
     * @description returning details related to logged in user
     */
    private function getUserDetails($id) {
        $userDetails = null;
        try{
            //logged in users details
            $userDetails = DB::table('users')
                ->select('users.*')
                ->where('id', $id)
                ->get();
        } catch (\Exception $exception) {
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }
        return $userDetails;
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
