<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\About;
use App\Post;
use App\Site;
use Session;
use App\Widget;
use App\Gallery;
use App\Images;
use App\calenderevent;
use App\removeduser;
use App\Template;
use App\slideimage;
use App\slidealbum;
use App\User;
use App\visitormail;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Mail;
use Mockery\Generator\StringManipulation\Pass\RemoveUnserializeForInternalSerializableClassesPass;
use Carbon\Carbon;
use App\ExceptionsLog;
use Illuminate\Pagination\LengthAwarePaginator;




class SiteController extends Controller
{

    public function index()
    {

      $template=template::paginate(15);
      $sites=Site::paginate(15);
      return view('sites.mysite')->with('sites',$sites)->with('temp',$template);

    }

    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {


        $tempname=DB::table('templates')->where('id',$id)->pluck('name');


        $site=new Site;
        $site->hostname=$request->hostname;
        $site->userid=Auth::user()->id;
        $site->templatename=$tempname[0];
        $site->sitename=$request->sitename;
        $site->save();

        $about=new About;
        $about->sitename=$site->sitename;
        $about->userid=1;
        $about->name=$request->name;
        $about->age=$request->age;
        $about->qualifications=$request->qualifications;
        $about->about=$request->about;
        $about->save();

        $sites=Site::paginate(2);
        $template=template::paginate(2);

        Session::flash('success','New Site Created Successfull');


        return redirect()->route('site.index');

    }

    public function getAlbum(Request $request) {

        $album=Gallery::find($request);
        return '$result';
    }

    public function getItems(Request $request) {

        if ($request) {
            $album = $request->input('album');
        }


        if ($album) {

            $album_id = DB::table('gallery')->where('name', $album)->pluck('id');
            $items = DB::table('images')
                ->leftJoin('gallery', 'images.gallery_id', '=', 'gallery.id')
                ->where('gallery.id', $album_id)
                ->get();
            return $items;
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      $loged_user = Auth::user()->id;


      $c_day = date("j");//31
      $c_month = date("n");//8
      $c_year = date("Y");//2016

      $day1 = date("j");
      $month1 = date("n");
      $year1 = date("Y");

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

      $day = $day1;
      $month = $month1;
      $year = $year1;

      $current_time_stamp= strtotime("$year1-$month1-$day1");
      $month_name= date("F", mktime(0, 0, 0, $month1, 10));
      $num_days = date("t",$current_time_stamp);
      $count = 0;
      if($month<10){$month="0".$month;}
      $event_list = calenderevent::all();

      $site=DB::table('sites')->where('sitename',$id)->first();
      $templateid=$site->templatename;
      $data=template::all()->where('name',$templateid);
      $color=" ";
      foreach($data as $key)
      {
        $color=$key->colour;
      }
      $about=DB::table('abouts')->where('sitename',$id)->get();
      $post=DB::table('posts')->where('sitename',$id)->get();
      $aboutobj=(object)$about;
      $postobj=(object)$post;

      $twiter=Widget::where('user_id',Auth::user()->id)->get();

      $albums=Gallery::where('created_by',Auth::user()->id)->get();

      $user=Auth::user()->name;

      return view('Live_templates.Temp1.first')->withSite($site)->withAbout($aboutobj)->withPost($postobj)->withUser($user)->withAlbums($albums)->withTwitter($twiter)->withDay($day)->withMonth($month)->withYear($year)->withC_day($c_day)->withC_year($c_year)->withC_month($c_month)->withEvent_list($event_list)->withLoged_user($loged_user)->withColor($color)->withCurrent_time_stamp($current_time_stamp)->withMonth_name($month_name)->withNum_days($num_days)->withCount($count);

    }


    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $oldtemp=$request->old;
        $newtemp=$request->new;
        $siteid=$request->siteid;
        $site=Site::find($siteid);
        $site->templatename=$newtemp;
        $site->save();
        return redirect('/showupdatedsites');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sitename=DB::table('sites')->where('siteid', '=', $id)->pluck('sitename');
        $site=$sitename[0];

        $val1=DB::table('sites')->where('siteid', '=', $id)->delete();
        $val2=DB::table('abouts')->where('sitename', '=', $site)->delete();
        $val4=DB::table('posts')->where('sitename', '=', $site)->delete();

        $sites=Site::paginate(2);
        $template=template::paginate(2);
        return redirect()->route('site.index');
    }

    // change template without effecting to data within the template
    public function ViewChangeTemp(Request $request)
    {
        $temp=$request->tempname;
        $siteid=$request->siteid;
        $template=template::all()->toArray();
        return view('changetemplate.changeTemp')->with('temp',$temp)->with('template',$template)->with('siteid',$siteid);
    }




}
