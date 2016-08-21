<?php

namespace App\Http\Controllers;

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
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
//use Ibox\Uploader\Uploader;
use Illuminate\Support\Facades\Mail;
use Mockery\Generator\StringManipulation\Pass\RemoveUnserializeForInternalSerializableClassesPass;


class AdminController extends Controller
{
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

        $filename = Input::get('name') . '-image.' . $image->getClientOriginalExtension();
        //$filename2 = Input::get('name') . '-source.' . $source->getClientOriginalExtension();
        $destinationPath = 'C:/wamp64/www/SEP_II/resources/views/upload_temp/'; // upload path
        $extension = $source->getClientOriginalExtension(); // getting image extension
        $filename2 = Input::get('name') . '-source.blade.'.$extension; // renameing image
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

        $Template->save();


        return back();

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

        return view('edit_template' , compact('temp'));

    }

    public function update(Request $request , Template $temp){

        //return $request;

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

        $temp->update();

        return redirect("/templates/edit");

    }

    public function delete(Template $temp){

        $temp->delete();

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

        $filename = Input::get('name') . '-image.' . $image->getClientOriginalExtension();

        Image::make($image)->save('/img/' . $filename);

        Image::make($image)->resize(150, 150)->save('/img/preview/' . $filename);

        $slideimage = new slideimage;
        $slideimage->name = Input::get('name');
        $slideimage->description = Input::get('description');
        $slideimage->slide_pic = $filename;


        $slideimage->save();

        return back();

    }


    public function add_to_album(Request $request){

        $images= Input::get('image_album');
//        $f_images= Input::get('front_image');

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

    public function change1(Request $request , slideimage $slide){

        $imagefirst = slideimage::where('status', 1)->get();
        foreach($imagefirst as $image) {
            $image->status = 2;
            $image->update();
        }
        $status = 1;
        $slide->status = $status;
        $slide->update();
        return redirect("/templates/slide");
    }

    public function change2(Request $request , slideimage $slide){

        $status = 2;
        $slide->status = $status;
        $slide->update();
        return redirect("/templates/slide");
    }

    public function remove_from_album(Request $request , slideimage $slide){

        $images= Input::get('image_album');
        foreach ($images as $image_id)
        {
            slideimage::where('id', $image_id)->update(['status' => 0]);
        }
        return redirect("/templates/slide");
    }

    public function getslideimage(){

        $image = slideimage::where('status', 2)->get();
        $imagefirst = slideimage::where('status', 1)->get();
        //$imagecount = slideimage::where('status', 1)->get()->count();
        // var_dump($imagecount);
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
        echo "<script>";
        if($user->type=='client') {
            $users['email'] = $user->email;
            $users['name'] = $user->name;

            Mail::send('mail.promotion', ['data' => $users], function ($m) use ($users) {
                $m->to($users['email'], $users['name'])->subject('Congratulation!')->from('azinabcoc@gmail.com');
            });

            $status = 'moderator';
            $user->type = $status;
            $user->update();
        }
        else{
            echo "alert('User is already in ADMIN access level');";
        }
        //return redirect("/admin/user/manage");
        echo "window.location.href='/admin/user/manage'</script>";

    }

    public function pro_super_admin(Request $request , User $user){
        echo "<script>";
        if($user->type=='moderator') {
            $users['email'] = $user->email;
            $users['name'] = $user->name;

            Mail::send('mail.promotion', ['data' => $users], function ($m) use ($users) {
                $m->to($users['email'], $users['name'])->subject('Congratulation!')->from('azinabcoc@gmail.com');
            });

            $status1 = 'admin';
            $user->type = $status1;
            $user->update();

            $loged_user = Auth::user();
            $status2 = 'moderator';
            $loged_user->type = $status2;
            $loged_user->update();
        }
        elseif($user->type=='client'){
            echo "alert('User cannot directly promote to moderator level');";
        }
        //return redirect("/admin/user/manage");
        echo "window.location.href='/admin/user/manage'</script>";

    }


    public function demote(Request $request , User $user){

        $users['reason']= Input::get('reason');
        $users['email']=$user->email;
        $users['name']=$user->name;

        Mail::send('mail.demotion', ['data' => $users], function ($m) use ($users){
            $m->to($users['email'], $users['name'])->subject('Demotion!')->from('azinabcoc@gmail.com');
        });

        $status = 'client';
        $user->type = $status;
        $user->update();
        return redirect("/admin/user/manage");

    }

    public function kickout(Request $request , User $user){

        $msg = Input::get('kick_message');
        $data['email']=$user->email;
        $data['name']=$user->name;
        $data['reason']=$msg;
        //view('mailbody',compact($reply));
        // var_dump($data);
        Mail::send('mail.kickout', ['data' => $data], function ($m) use ($data){
            $m->to($data['email'], $data['name'])->subject('Kicked- out!')->from('azinabcoc@gmail.com');
        });
        $RUser = new removeduser();
        $RUser->name = $user->name;
        $RUser->email = $user->email;
        $RUser->reason = $msg;
        $RUser->done_by = Auth::user()->name;

        $RUser->save();
        $user->delete();
        return redirect("/admin/user/manage");

    }

    public function re_user_view(){


        $re_users = removeduser::all();

        return view('admin.removed_user' , compact('re_users'));

    }

}
