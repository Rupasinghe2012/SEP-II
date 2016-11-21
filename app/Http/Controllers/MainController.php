<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\slideimage;
use App\visitormail;
use App\Template;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\ExceptionsLog;
use Illuminate\Pagination\LengthAwarePaginator;

class MainController extends Controller
{
    private $notification;
    private $userId;
    private $mail;
    /**
     *MainController constructor.
     */
//    public function __construct()
//    {
//        $this->userId=Auth::user()->id;
//        $this->mail=Auth::user()->email;
//        $this->notification = new NotificationController();
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $image = slideimage::where('status', 2)->get();
        $imagefirst = slideimage::where('status', 1)->get();
        //$imagecount = slideimage::where('status', 1)->get()->count();
        // var_dump($imagecount);
        return view('welcome' , compact('image'),compact('imagefirst'),compact('imagecount'));
    }

    public function view_mail()
    {
//        $visitormails = visitormail::where('reply', 'not yet reply')->orderby('id','desc')->groupby('sender_email')->get();
        $allmail=visitormail::wherein('id',function($query){ $query->selectRaw('max(id)')->from('visitormails')->groupby('sender_email');})->orderby('id','desc')->paginate(5);
        return view('admin.mail_view' , compact('visitormails'),compact('allmail'));
    }

    public function show_mail(visitormail $mail)
    {
        $visitormails = visitormail::where('sender_email', $mail->sender_email)->orderby('id', 'desc')->paginate(2);
        $usermail = visitormail::where('sender_email', $mail->sender_email)->groupBy('sender_email')->get();
        foreach ($visitormails as $mails)
        {
            $mails->view_status = 1;
            $mails->update();
        }

        return view('admin.mail_show' , compact('visitormails'),compact('usermail'));
    }

    public function store_mail(Request $request){
        $mail = new visitormail();
        $mail->sender_name = Input::get('name');
        $mail->sender_email = Input::get('email');
        $mail->subject = Input::get('subject');
        $mail->description = Input::get('message');

        $mail->save();

        return back();

    }

    public function ignor_mail(Request $request , visitormail $mail){
        try {
            $reply = "Ignore";
            $mail->reply = $reply;
            $mail->reply_by = Auth::user()->name;
            if($mail->update()){
                $this->notification->addNotification($this->userId,'ignore_mail');
            }
            return redirect("/templates/mail/view");
        }
        catch (\Exception $exception){
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }
    }

    public function reply_mail(Request $request , visitormail $mail){

        $reply = Input::get('reply_message');
        try {
            if (($mail->reply) != "not yet reply") {
                $previous = $mail->reply;
                $mail->reply = $previous . "  -  updated  ->  " . $reply;
            } else {
                $mail->reply = $reply;
            }

            $mail->reply_by = Auth::user()->name;

            $data['email'] = $mail->sender_email;
            $data['name'] = $mail->sender_name;
            $data['body'] = $reply;
            $data['reply_by'] = Auth::user()->name;

            //view('mailbody',compact($reply));
            // var_dump($data);
            Mail::send('mail.mailbody', ['data' => $data], function ($m) use ($data) {
                $m->to($data['email'], $data['name'])->subject('Your Reminder!')->from('azinabcoc@gmail.com');
            });
            $mail->update();

            return redirect("/templates/" . $mail->id . "/show");
        }
        catch (\Exception $exception){
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }

    }

}
