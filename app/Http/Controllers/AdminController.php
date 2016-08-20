<?php
namespace App\Http\Controllers;

use App\ExceptionsLog;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class AdminController
 * @description Handles most of the admin page logic
 * @package App\Http\Controllers
 */

class AdminController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('home');
    }
}
