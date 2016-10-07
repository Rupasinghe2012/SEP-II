<?php

namespace App\Http\Controllers;
use App\About;
use App\Post;
use App\Site;
use App\template;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\TemplateDataRequest;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;
use Session;

class PreviewController extends Controller
{
    public function insert(Request $request,$id)
    {

        $site=new Site;


        // if(!empty($host)){
        //   Session::flash('host','HostName  Exists');
        //   return view('sitecreation.test')->with('id',$id);;
        // }


          $site->hostname=$request->hostname;
          $site->userid=1;
          $site->templateid=$id;
          $site->sitename=$request->sitename;
          $site->save();

          $about=new About;
          $about->siteid=$site->siteid;
          $about->userid=1;
          $about->name=$request->name;
          $about->age=$request->age;
          $about->qualifications=$request->qualifications;
          $about->about=$request->about;
          $about->save();

          $sites=Site::all();
          $template=template::all();

          Session::flash('success','New Site Created Successfull');

          return view('sites.mysite')->with('sites',$sites)->with('temp',$template);


    }
    public function read()
    {
//        $post=Post::all();
//        $sites=Site::all();
//       return view('site')->with('sites',$sites)->with('post',$post);
        $template=template::all();
        $sites=Site::all();
        return view('sites.mysite')->with('sites',$sites)->with('temp',$template);


    }
    public function viewsite($siteid)
    {


        $site=DB::table('sites')->where('siteid',$siteid)->first();
        $templateid=$site->templateid;
        $data=template::all()->where('id',$templateid);
        $color=" ";
        foreach($data as $key)
        {
          $color=$key->colour;
        }
        $about=DB::table('abouts')->where('siteid',$siteid)->first();
        $post=DB::table('posts')->where('siteid',$siteid)->first();
//        $data['color']=$color;
//        $data['about']=$about;
//        $data['post']=$post;
         return view('Live_templates.Temp1.first',compact('color'))->with('about',$about)->with('site',$site)->with('post',$post);
//        /return view('Live_templates.Temp1.first',compact('data'));

    }
    public function deletesite($siteid)
    {
        $val1=DB::table('sites')->where('siteid', '=', $siteid)->delete();
        $val2=DB::table('abouts')->where('siteid', '=', $siteid)->delete();
        $val3=DB::table('abouts')->where('siteid', '=', $siteid)->delete();
        $val4=DB::table('posts')->where('siteid', '=', $siteid)->delete();

        $sites=Site::all();
         $template=template::all();
        return view('sites.mysite')->with('sites',$sites)->with('temp',$template);

    }
    public function updatetemplateid($id)
    {
        // $count=DB::table('sites')->where('templateid',$id);
        DB::table('sites')
            ->where('templateid',$siteid)
            ->update(array('description' => $request->description,'image'=>$filename));

    }

}
