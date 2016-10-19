<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\About;
use App\Post;
use App\Site;
use App\template;
use Session;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $template=template::paginate(2);
      $sites=Site::paginate(2);
      return view('sites.mysite')->with('sites',$sites)->with('temp',$template);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {

        //
        $tempname=DB::table('templates')->where('id',$id)->pluck('name');
        //

        $site=new Site;
        $site->hostname=$request->hostname;
        $site->userid=1;
        $site->templatename=$tempname[0];
        $site->sitename=$request->sitename;
        $site->save();
        //
        $about=new About;
        $about->sitename=$site->sitename;
        $about->userid=1;
        $about->name=$request->name;
        $about->age=$request->age;
        $about->qualifications=$request->qualifications;
        $about->about=$request->about;
        $about->save();
        //
        $sites=Site::paginate(2);
        $template=template::paginate(2);

        Session::flash('success','New Site Created Successfull');

        // return view('sites.mysite')->with('sites',$sites)->with('temp',$template);
        return redirect()->route('site.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
      return view('Live_templates.Temp1.first',compact('color'))->withAbout($aboutobj)->withSite($site)->withPost($postobj);
      //


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
        // return view('sites.mysite')->with('sites',$sites)->with('temp',$template);
        return redirect()->route('site.index');
    }

    public function ViewChangeTemp(Request $request)
    {
        // $name=$request->name;
        $temp=$request->tempname;
        $siteid=$request->siteid;
        $template=template::all()->toArray();
        return view('changetemplate.changeTemp')->with('temp',$temp)->with('template',$template)->with('siteid',$siteid);
    }


}
