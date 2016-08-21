<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Notification;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

/**
 * Class NotificationController
 * @package App\Http\Controllers
 * @description handles the notification system
 */
class NotificationController extends Controller
{
    private $userId;

    /**
     * ProjectsController constructor.
     * @description get and sets the session details
     */
    public function __construct()
    {
        $this->userId = Auth::user()->id;
    }

    public function index()
    {

//        $user=User::all();
//        $not= Notification::where('affected_user',$this->userId)->get();

        $notifications = new Collection();
        $data=DB::table('notification')
            ->join('users', 'notification.triggered_by', '=', 'users.id')
            ->where('notification.affected_user', '=', $this->userId)
            ->select('notification.*', 'users.name')
            ->get();

        foreach($data as $notification) {
            $notification->diff = Carbon::createFromFormat('Y-m-d H:i:s', $notification->time)
                ->diffForHumans();
            $notifications->push($notification);
        }
        return view('/NotificationLog' , compact('notifications'));
    }

    /**
     * @return int
     * @description fetch unread notification and serve them to the user
     */
    function show(){

        $notifications = new Collection();
        $data=DB::table('notification')
            ->join('users', 'notification.triggered_by', '=', 'users.id')
            ->where('notification.affected_user', '=', $this->userId)
            ->where('notification.read', 0)
            ->select('notification.*', 'users.name')
            ->get();

        foreach($data as $notification) {
            $notification->diff = Carbon::createFromFormat('Y-m-d H:i:s', $notification->time)
                ->diffForHumans();
            $notifications->push($notification);
        }

        if(count($notifications)) {
            return $notifications;
        } else {
            return 0;
        }

    }

    /**
     * @description updates the notification status to read after user completed reading.
     */
    function update(){
        $input = Input::all();

        DB::table('notification')
            ->where('read', 0)
            ->update(['read' => 1]);
    }

    public function addNotification($affectedUser,$type){
        DB::table('notification')->insert([
            'triggered_by' => $this->userId,
            'affected_user' => $affectedUser,
            'read' => 0, 'type' => $type,
            'time' => Carbon::now()->toDateTimeString()
        ]);
    }
    public function count()
    {
//        $count = Notification::where('read','=','0')->count();
        $count=DB::table('notification')
            ->join('users', 'notification.triggered_by', '=', 'users.id')
            ->where('notification.affected_user', '=', $this->userId)
            ->where('notification.read', 0)
            ->select('notification.*', 'users.name')
            ->count();
        return $count;
    }

}