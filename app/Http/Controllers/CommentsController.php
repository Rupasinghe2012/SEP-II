<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Comment;
use App\Post;
use Illuminate\Support\Facades\Redirect;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $comments=Comment::all();
        return view('viewcomments.comments')->withComment($comments);
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
    public function store(Request $request)
    {
        $postid=$request->p;
        $email=$request->e;
        $name=$request->n;
        $sitename=$request->s;
        $com=$request->c;

        $post=Post::find($postid);

        $comment=new Comment();
        $comment->name=$name;
        $comment->email=$email;
        $comment->comment=$com;
        $comment->approved=false;
        $comment->post()->associate($post);
        $comment->sitename=$sitename;
        if($comment->save())
        {
            // $com=Comment::where('post_id',$postid)->get();
            return 1;
        }

        // return Redirect::back()->with('comments',$com);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return $id;

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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $val=Comment::destroy($id);
        if($val)
        {
          return Redirect::back();
        }
    }


    //get the checked states and updates the approve
    //column in the comments table
    //@param : comment id , chk variable
    //@return : changed state
    public function approve(Request $request)
    {
        if($request->chk == 1)
        {
            $comment=Comment::find($request->comid);
            $comment->approved=true;
            $comment->save();
            return "checked";
        }
        elseif($request->chk == 0) {
            $comment=Comment::find($request->comid);
            $comment->approved=false;
            $comment->save();
            return "unchecked";
        }
    }

    //get all comment which are approved
    //@return : all approved commment ids
    public function getApproveComments()
    {
        $approvecomments=DB::table('comments')->where('approved',true)->get();
        echo json_encode($approvecomments);
    }

    //get comments from the database
    //@return : comments
    public function getComments(Request $request)
    {
        $result=Comment::where('post_id',$request->pid)->Where('approved',true)->get();

        if($result->count())
        {
            $com=" ";
            foreach($result as $obj)
            {
                $com=$com."<div class='comment-text'>".
                  "<span class='username'>".
                    "<p><b>$obj->name</b></p>".
                    "<span class='text-muted pull-right'>$obj->created_at</span></p>".
                  "</span>$obj->comment</div>";


            }
            echo $com;
        }
        else {
            echo "<p >No Comments To Display</p>";
        }


    }

}
