<?php

namespace App\Http\Controllers;

use App\calenderevent;
use App\removeduser;
use App\Template;
use App\slideimage;
use DB;
use App\slidealbum;
use App\User;
use App\visitormail;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Mockery\Generator\StringManipulation\Pass\RemoveUnserializeForInternalSerializableClassesPass;
use Carbon\Carbon;
use App\ExceptionsLog;


class AdminController extends Controller
{
    private $notification;
    private $userId;
    private $mail;
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->userId=Auth::user()->id;
        $this->mail=Auth::user()->email;
        $this->notification = new NotificationController();
    }


    public function index(){

        return view('admin.add_temp');
    }

    /**
     * @param Request $request
     * @return view
     * This function stores an image and a source fle uploaded by the user in the database.
     * The names of the uploaded files are stored as the provided template name and the original file extension.
     */
    public function store(Request $request){
        $image = Input::file('temp_pic');
        $source = Input::file('temp_source');
        $is_ex = 0;
        try {
            $name = Input::get('name');
            $ex_file = Template::all();
            foreach ($ex_file as $ex)
            {
                if($ex->name==$name)
                {
                    $is_ex++;
                }
            }

            echo "<script>";
            if($is_ex==0) {
                $filename = Input::get('name') . '-image.' . $image->getClientOriginalExtension();
                //$filename2 = Input::get('name') . '-source.' . $source->getClientOriginalExtension();
                $destinationPath = 'C:/wamp64/www/SEP_II/resources/views/upload_temp/'; // upload path
                $extension = $source->getClientOriginalExtension(); // getting image extension
                $filename2 = Input::get('name') . '-source.blade.' . $extension; // renameing image
                $source->move($destinationPath, $filename2);

                Image::make($image)->save('images/' . $filename);

                Image::make($image)->resize(150, 150)->save('images/previews/' . $filename);

                $Template = new Template;
                $Template->name = Input::get('name');
                $Template->description = Input::get('description');
                $Template->price = Input::get('price');
                $Template->colour = Input::get('colour');
                // $Template->url = Input::get('url');
                $Template->temp_pic = $filename;
                $Template->temp_source = $filename2;

            if($Template->save()){
                $this->notification->addNotification($this->userId,'add_temp');
            }
            }
            else{
                echo "alert('Template name already used');";
            }
            echo "window.location.href='/templates/new'</script>";
        }
        catch (\Exception $exception){
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }

    }

    public function show( Template $temp){

        $pieces = explode(".", $temp->temp_source);
        $url="upload_temp/".$pieces[0];
        return view($url);

    }
    public function view(){


        $templates = Template::all();

        return view('admin.temp_update' , compact('templates'));

    }

    public function edit(Template $temp){

        return view('admin.edit_template' , compact('temp'));

    }

    public function update(Request $request , Template $temp){
        $is_ex = 0;
        $name = Input::get('name');
        try {
            $ex_file = Template::where('id','<>',$temp->id)->get();
            foreach ($ex_file as $ex)
            {
                if($ex->name==$name)
                {
                    $is_ex++;
                }
            }

            echo "<script>";
            if($is_ex==0) {
                $image = Input::file('temp_pic');
                $source = Input::file('temp_source');

                if($image != null ) {
                    $filename = Input::get('name') . '-image.' . $image->getClientOriginalExtension();
                    Image::make($image)->save('images/' . $filename);
                    Image::make($image)->resize(150, 150)->save('images/previews/' . $filename);
                    $temp->temp_pic = $filename;
                }

                if($source != null) {
                    $destinationPath = 'C:/wamp64/www/SEP_II/resources/views/upload_temp/'; // upload path
                    $extension = $source->getClientOriginalExtension(); // getting image extension
                    $filename2 = Input::get('name') . '-source.blade.'.$extension; // renameing image
                    $source->move($destinationPath, $filename2);
                    $temp->temp_source = $filename2;

                }

                $temp->name = $request->name;
                $temp->description = $request->description;
                $temp->colour = $request->colour;
                $temp->price = $request->price;

                if($temp->update()){
                    $this->notification->addNotification($this->userId,'update_temp');
                }
                echo "window.location.href='/templates/edit'</script>";
            }
            else{
                echo "alert('Template name already used');";
                echo "window.location.href='/templates/$temp->id/edit'</script>";

            }
        }
        catch (\Exception $exception){
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }
    }

    public function delete(Template $temp){
        try {
            if($temp->delete()){
                $this->notification->addNotification($this->userId,'delete_temp');
            }
        }
        catch (\Exception $exception){
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }
        return back();
    }

    public function slide_view(){
        $slide_album = slideimage::whereBetween('status',[1,2])->get();
        $slideimages = slideimage::where('status',0)->get();
        $slide_album_count=slideimage::whereBetween('status',[1,2])->count();

        return view('admin.slide_show' , compact('slideimages','slide_album','slide_album_count'));
    }


    public function store_image(Request $request){

        $image = Input::file('slide_pic');
        $is_ex = 0;
        $name = Input::get('name');
        try {
            $ex_file =slideimage::all();
            foreach ($ex_file as $ex)
            {
                if($ex->name==$name)
                {
                    $is_ex++;
                }
            }

            echo "<script>";
            if($is_ex==0) {

                $filename = Input::get('name') . '-image.' . $image->getClientOriginalExtension();

                Image::make($image)->save('/img/' . $filename);

                Image::make($image)->resize(150, 150)->save('/img/preview/' . $filename);

                $slideimage = new slideimage;
                $slideimage->name = Input::get('name');
                $slideimage->description = Input::get('description');
                $slideimage->slide_pic = $filename;


                if($slideimage->save()){
                    $this->notification->addNotification($this->userId,'add_slide');
                }
            }
            else{
                echo "alert('Slide image name already used');";
            }
            echo "window.location.href='/templates/slide'</script>";
        }
        catch (\Exception $exception){
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }

    }


    public function add_to_album(Request $request){

        $images= Input::get('image_album');
        try {
            foreach ($images as $image_id)
            {
                slideimage::where('id', $image_id)->update(['status' => 2]);
            }

            $is_there = slideimage::where('status',1)->count();
            if($is_there < 1) {
                $min_id = slideimage::min('id');
                slideimage::where('id', $min_id)->update(['status' => 1]);
            }
            return back();
        }
        catch (\Exception $exception){
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }

    }

    public function change1(Request $request , slideimage $slide){
        try {
            $imagefirst = slideimage::where('status', 1)->get();
            foreach ($imagefirst as $image) {
                $image->status = 2;
                $image->update();
            }
            $status = 1;
            $slide->status = $status;
            $slide->update();
            return redirect("/templates/slide");
        }
        catch (\Exception $exception){
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }
    }

    public function change2(Request $request , slideimage $slide){
        try {
            $status = 2;
            $slide->status = $status;
            $slide->update();
            return redirect("/templates/slide");
        }
        catch (\Exception $exception){
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }
    }

    public function remove_from_album(Request $request , slideimage $slide){

        $images= Input::get('image_album');
        try {
            foreach ($images as $image_id) {
                slideimage::where('id', $image_id)->update(['status' => 0]);
            }
            $this->notification->addNotification($this->userId,'remove_slide');
            return redirect("/templates/slide");
        }
        catch (\Exception $exception){
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }
    }

    public function getslideimage(){
        $image = slideimage::where('status', 2)->get();
        $imagefirst = slideimage::where('status', 1)->get();
        return view('welcome' , compact('image'),compact('imagefirst'));
    }

    public function admin_view(){

        $count['user'] = User::all()->count();
        $count['temp'] = Template::all()->count();
        $count['ignor'] = visitormail::where('reply','ignore')->count();
        $count['mail'] = visitormail::all()->count();
        $count['queue'] = visitormail::where('reply','not yet reply')->count();
        $count['replied']=$count['mail']-($count['ignor']+$count['queue']);
        return view('admin.admin_home',compact('count'));
    }

    public function user_view(){
        $users = User::where('id','<>',Auth::user()->id)->get();
        $loged_user = Auth::user();
        return view('admin.user_manage' , compact('users','loged_user'));

    }

    public function promote(Request $request , User $user){
        try {
            echo "<script>";
            if ($user->type == 'client') {
                $users['email'] = $user->email;
                $users['name'] = $user->name;

                Mail::send('mail.promotion', ['data' => $users], function ($m) use ($users) {
                    $m->to($users['email'], $users['name'])->subject('Congratulation!')->from('azinabcoc@gmail.com');
                });

                $status = 'moderator';
                $user->type = $status;
                if($user->update()) {
                    $this->notification->addNotification($this->userId,'promote_mod');
                }
            } else {
                echo "alert('User is already in ADMIN access level');";
            }
            //return redirect("/admin/user/manage");
            echo "window.location.href='/admin/user/manage'</script>";
        }
        catch (\Exception $exception){
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }

    }

    public function pro_super_admin(Request $request , User $user){
        try {
            $loged_user = Auth::user();
            $users['email'] = $user->email;
            $users['name'] = $user->name;
            $users['log_user_name'] = $loged_user->name;
            $users['log_user_email'] = $loged_user->email;

            Mail::send('mail.pro_admin', ['data' => $users], function ($m) use ($users) {
                $m->to($users['email'], $users['name'])->subject('Congratulation!')->from('azinabcoc@gmail.com');
            });

            Mail::send('mail.dem_admin', ['data' => $users], function ($m) use ($users) {
                $m->to($users['log_user_email'], $users['log_user_name'])->subject('Attention!')->from('azinabcoc@gmail.com');
            });

            $status1 = 'admin';
            $user->type = $status1;
            $user->update();


            $status2 ='moderator';
            $loged_user->type = $status2;
            $loged_user->update();

            return redirect("/admin/user/manage");
        }
        catch (\Exception $exception){
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }

    }


    public function demote(Request $request , User $user){

        $users['reason']= Input::get('reason');
        $users['email']=$user->email;
        $users['name']=$user->name;
        try {
            Mail::send('mail.demotion', ['data' => $users], function ($m) use ($users) {
                $m->to($users['email'], $users['name'])->subject('Demotion!')->from('azinabcoc@gmail.com');
            });

            $status = 'client';
            $user->type = $status;
            if($user->update()){
                $this->notification->addNotification($this->userId,'demote');
            }
            return redirect("/admin/user/manage");
        }
        catch (\Exception $exception){
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }
    }

    public function kickout(Request $request , User $user){

        $msg = Input::get('kick_message');
        $data['email']=$user->email;
        $data['name']=$user->name;
        $data['reason']=$msg;
       try {
           Mail::send('mail.kickout', ['data' => $data], function ($m) use ($data) {
               $m->to($data['email'], $data['name'])->subject('Kicked- out!')->from('azinabcoc@gmail.com');
           });
           $RUser = new removeduser();
           $RUser->name = $user->name;
           $RUser->email = $user->email;
           $RUser->reason = $msg;
           $RUser->done_by = Auth::user()->name;

           if($RUser->save()){
               if($user->delete()){
                   $this->notification->addNotification($this->userId,'kicked');
               }
               
           }
           return redirect("/admin/user/manage");
       }
       catch (\Exception $exception){
           $exceptionData['user_id'] = $this->userId;
           $exceptionData['exception'] = $exception->getMessage();
           $exceptionData['time'] = Carbon::now()->toDateTimeString();

           ExceptionsLog::create($exceptionData);
       }
    }

    public function re_user_view(){
        $re_users = removeduser::all();
        return view('admin.removed_user' , compact('re_users'));

    }
    public function calender_view(){

        $loged_user = Auth::user();

        $c_day = date("j");//31
        $c_month = date("n");//8
        $c_year = date("Y");//2016

        $day = date("j");
        $month = date("n");
        $year = date("Y");

        $button = Input::get('change');
        if($button!=null) {
            $v_month = Input::get('month_num');
            $v_year = Input::get('year');
        }
        if($button=="PREVIOUS")
        {
            if($v_month==1)
            {
                $month = 12;
                $year = $v_year-1;
            }
            else
            {
                $month = $v_month-1;
                $year = $v_year;
            }
        }

        if($button=="NEXT")
        {
            if($v_month==12)
            {
                $month = 1;
                $year = $v_year+1;
            }
            else
            {
                $month = $v_month+1;
                $year =$v_year;
            }
        }

        $data['day'] = $day;
        $data['month'] = $month;
        $data['year'] = $year;

        $data['current_time_stamp'] = strtotime("$year-$month-$day");
        $data['month_name'] = date("F", mktime(0, 0, 0, $month, 10));
        $data['num_days'] = date("t",$data['current_time_stamp']);
        $data['count'] = 0;
        if($month<10){$month="0".$month;}
        $event_list = calenderevent::all();

        return view('calender',compact('data','day','month','year','c_day','c_year','c_month','event_list','loged_user'));

    }

    public function calender_add_event(){

        echo "<script>";
        $title = Input::get('title');
        $detail = Input::get('details');
        $s_date = Input::get('str_date');
        $s_time = Input::get('str_time');
        $e_time = Input::get('end_time');
        $e_date = Input::get('end_date');
        $type = Input::get('type');
        $venue = Input::get('venue');

        $current_date = date("Y-m-d");
        if (strtotime($s_date) < strtotime($current_date) || strtotime($e_date) < strtotime($current_date) || strtotime($s_date) < strtotime($e_date)) {
            echo "alert('Invalid date selection.(Both starting and ending dates must be greater than current date.Ending date must be greater than Starting date.)');";
        }
        elseif(strtotime($s_time) > strtotime($e_time)){
            echo "alert('Invalid time(starting time can not be less than end time)');";
        }
        else {

            if($type=="Once")
            {
                $count=01;
                while(strtotime($s_date) <= strtotime($e_date))
                {
                    $loged_user = Auth::user();
                    $event = new calenderevent();
                    $event->title = $title."( Event Day - ".$count." )";
                    $event->description = $detail;
                    $event->event_start_date = $s_date;
//                    $event->event_end_date = $e_date;
                    $event->venue = $venue;
                    $event->type = $type;
                    $event->s_time = $s_time;
                    $event->e_time = $e_time;
                    $event->user_name = $loged_user->name;
                    $event->user_id = $loged_user->id;

                    $event->save();
                    $s_date = date ("Y-m-d", strtotime("+1 days", strtotime($s_date)));
                    $count++;
                }
            }

            if($type=="Weekly")
            {
                $count=01;
                while(strtotime($s_date) <= strtotime($e_date))
                {
                    $loged_user = Auth::user();
                    $event = new calenderevent();
                    $event->title = $title."( Event Day - ".$count." )";
                    $event->description = $detail;
                    $event->event_start_date = $s_date;
//                    $event->event_end_date = $e_date;
                    $event->venue = $venue;
                    $event->type = $type;
                    $event->s_time = $s_time;
                    $event->e_time = $e_time;
                    $event->user_name = $loged_user->name;
                    $event->user_id = $loged_user->id;

                    $event->save();
                    $s_date = date ("Y-m-d", strtotime("+7 days", strtotime($s_date)));
                    $count++;
                }
            }

            if($type=="Monthly")
            {
                $count=01;
                while(strtotime($s_date) <= strtotime($e_date))
                {
                    $loged_user = Auth::user();
                    $event = new calenderevent();
                    $event->title = $title."( Event Day - ".$count." )";
                    $event->description = $detail;
                    $event->event_start_date = $s_date;
//                    $event->event_end_date = $e_date;
                    $event->venue = $venue;
                    $event->type = $type;
                    $event->s_time = $s_time;
                    $event->e_time = $e_time;
                    $event->user_name = $loged_user->name;
                    $event->user_id = $loged_user->id;

                    $event->save();
                    $s_date = date ("Y-m-d", strtotime("+1 month", strtotime($s_date)));
                    $count++;
                }
            }

//            $loged_user = Auth::user();
//            $event = new calenderevent();
//            $event->title = $title;
//            $event->description = $detail;
//            $event->event_start_date = $s_date;
//            $event->event_end_date = $e_date;
//            $event->venue = $venue;
//            $event->type = $type;
//            $event->s_time = $s_time;
//            $event->e_time = $e_time;
//            $event->user_name = $loged_user->name;
//            $event->user_id = $loged_user->id;
//
//            $event->save();
//            return redirect("/calender/view");
        }
        echo "window.location.href='/calender/view'</script>";
    }

}
