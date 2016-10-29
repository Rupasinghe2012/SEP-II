<?php

namespace App\Http\Controllers;
use App\Post;
use App\Site;
use App\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\ExceptionsLog;
use Carbon\Carbon;
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
     private $userId;
     private $mail;

    public function __construct()
    {
        $this->userId=Auth::user()->id;
        $this->mail=Auth::user()->email;
    }

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
        $sites=Site::paginate(5);
        $allpost=Post::paginate(5);
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
        try {

            $post=new Post;
            $post->userid=$this->userId;
            $post->sitename=$request->s;
            $post->description=$request->d;
            if($post->save())
            {
                return "t";
            }

        } catch (Exception $exceptionData) {
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
            return "f";
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
        try {
            $siteid=$request->post;
            $data=$request->d;


            $post=Post::find($siteid);
            $post->description=$data;
            if($post->save())
            {
                    return "t";
            }
        } catch (Exception $exceptionData) {
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
            return "f";
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if(DB::table('posts')->where('id', '=', $id)->delete())
            {
                return redirect()->route('post.create');
            }
        } catch (Exception $exceptionData) {
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }



    }
}
