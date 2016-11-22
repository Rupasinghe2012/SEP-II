<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use Illuminate\Http\Request;
use App\template;
use App\Http\Requests;
use App\Site;
use Illuminate\Support\Facades\DB;

class Loaddemo_controller extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return loads the template view
     */
    public function index()
    {
    //   $template = DB::table('mytemplates')
    //           ->leftJoin('templates', 'mytemplates.templateid', '=', 'templates.id')
    //           ->select('templates.*')
    //           ->get();

        $template=template::all()->toArray();
        return view('templates.temp',compact('template'));
    }

    /**
     * @return the demo template
     */
    public function demo()
    {
        return view('Template.Temp1.first');

    }
    public function about()
    {
        return view('Templates.about');
    }
    public function post()
    {
        return view('Templates.post');
    }
    public function contact()
    {
        return view('Templates.contact');
    }
    public function edit($id)
    {
          return view('sitecreation.createsite')->with('id',$id);

    }

    public function editpost()
    {
        $sites=Site::all();
        $allpost=Post::all();
        return view('posts.addpost')->with('test',$allpost)->with('site',$sites);
    }

    public function live()
    {
        return view('EditTemplate.Tem1.index');
    }
    public function live_demo()
    {
        return view('EditTemplate.Tem1.index');
    }
    public function live_about()
    {
        return view('EditTemplate.Tem1.about');
    }
    public function live_post()
    {
        return view('EditTemplate.Tem1.post');
    }
    public function live_contact()
    {
        return view('EditTemplate.Tem1.contact');
    }



}
