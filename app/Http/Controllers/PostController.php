<?php

namespace App\Http\Controllers;
use App\Post;
use App\Site;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;
// include composer autoload
// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sites=Site::paginate(2);
        $allpost=Post::paginate(2);
        return view('posts.addpost')->with('test',$allpost)->with('site',$sites);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $image = Input::file('image');

        $filename = Input::get('name') . '-image.' . $image->getClientOriginalExtension();

        Image::make($image)->save('resources/assets/img/postimages/'.$filename);

        Image::make($image)->resize(50, 50)->save('resources/assets/img/postpreviewimage/' . $filename);

        $post=new Post;
        $post->userid=2;
        $post->sitename=$request->sitename;
        $post->description=$request->description;
        $post->image=$filename;

        if($post->save())
        {
            $allpost=Post::paginate(2);
            $sites=Site::paginate(2);
            return view('posts.addpost')->with('test',$allpost)->with('site',$sites);
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
      $allposts=Post::all();
      $users=DB::table('posts')->where('id',$id)->first();
      return view('posts.updatepost',compact('users'))->with('test',$allposts);

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

        $image = Input::file('image');

        $filename = Input::get('name') . '-image.' . $image->getClientOriginalExtension();

        Image::make($image)->save('resources/assets/img/postimages/'.$filename);

        Image::make($image)->resize(50, 50)->save('resources/assets/img/postpreviewimage/' . $filename);

        $siteid=$request->id;

        DB::table('posts')
            ->where('sitename',$siteid)
            ->update(array('description' => $request->description,'image'=>$filename));

        $allposts=Post::all();
        $sites=Site::all();
        $users=DB::table('posts')->where('sitename',$siteid)->first();
        return view('posts.updatepost',compact('users'))->with('test',$allposts)->with('site',$sites);


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if(DB::table('posts')->where('id', '=', $id)->delete())
        {
            return redirect()->route('post.create');
        }

    }
}
