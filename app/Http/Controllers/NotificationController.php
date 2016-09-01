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
use App\ExceptionsLog;

/**
 * Class NotificationController
 * @package App\Http\Controllers
 * @description handles the notification system
 */
class NotificationController extends Controller
{
    private $userId;

    /**
     * NotificationController constructor.
     * @description get and sets the session details
     */
    public function __construct()
    {
        $this->userId = Auth::user()->id;
    }

    public function index()
    {
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
        return view('/notification_log' , compact('notifications'));
    }

    /**
     * @return int
     * @description fetch unread notification and serve them to the user
     */
    function show(){
        try {
            $notifications = new Collection();
            $data = DB::table('notification')
                ->join('users', 'notification.triggered_by', '=', 'users.id')
                ->where('notification.affected_user', '=', $this->userId)
                ->where('notification.read', 0)
                ->select('notification.*', 'users.name')
                ->get();

            foreach ($data as $notification) {
                $notification->diff = Carbon::createFromFormat('Y-m-d H:i:s', $notification->time)
                    ->diffForHumans();
                $notifications->push($notification);
            }

            if (count($notifications)) {
                return $notifications;
            } else {
                return 0;
            }
        }
        catch(\Exception $exception) {
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }
    }

    /**
     * @description updates the notification status to read after user completed reading.
     */
    function update(){
        $input = Input::all();
        try {
            DB::table('notification')
                ->where('read', 0)
                ->update(['read' => 1]);
        }
        catch(\Exception $exception) {
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }
    }

    public function addNotification($affectedUser,$type){
        try {
            DB::table('notification')->insert([
                'triggered_by' => $this->userId,
                'affected_user' => $affectedUser,
                'read' => 0, 'type' => $type,
                'time' => Carbon::now()->toDateTimeString()
            ]);
        }
        catch(\Exception $exception) {
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }
    }
    public function count()
    {
        try {
            $count = DB::table('notification')
                ->join('users', 'notification.triggered_by', '=', 'users.id')
                ->where('notification.affected_user', '=', $this->userId)
                ->where('notification.read', 0)
                ->select('notification.*', 'users.name')
                ->count();
            return $count;
        }
        catch(\Exception $exception) {
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }
    }

}