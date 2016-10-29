<?php
namespace App\Http\Controllers;

use App\ExceptionsLog;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Post;
use App\Notification;
use App\Template;
use App\Comment;
use App\calenderevent;
use App\Gallery;
use App\Site;
use App\preorder;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count['not'] = Notification::where('triggered_by','=',Auth::user()->id)->count();
        $count['post'] = Post::all()->count();
        $count['templates']=Template::all()->count();
        $count['comments']=Comment::all()->count();
        $count['events']=calenderevent::where('user_id','=',Auth::user()->id)->count();
        $count['galery']=Gallery::all()->count();
        $count['sites']=Site::all()->count();
        $count['orders']=preorder::all()->count();

        return view('home',compact('count'));
    }
}
