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
        $count['not'] = Notification::where('id','<>',Auth::user()->id)->count();
        $count['post'] = Post::all()->count();
        return view('home',compact('count'));
    }
}
