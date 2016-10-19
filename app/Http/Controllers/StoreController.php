<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\preorder;
use App\preorderItem;
use App\Template;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;
use App\ExceptionsLog;
use App\Http\Requests;

class StoreController extends Controller
{
//    public function index(){
//        return view('store');
//    }

    public function __construct()
    {
        $this->userId = Auth::user()->id;
    }
    public function index($category=NULL)
    {
        //$categoryList = category::select('name')->get();
        if (session()->has($this->userId)) {
            $orderItems = DB::table('session_preorder')
                ->where('customer_id', Session::get($this->userId))
                ->count();
        } else {
            $orderItems = 0;
        }

        if ($category) {

//            $items = DB::table('inv_items')->where('department_id', $category_id)->get();
//            return view('store')->withCategory($category)->withOrderitems($orderItems);
        }
        else {
            $category='All';
            $items = DB::table('templates')->get();
            return view('store')->withCategory($category)->withItems($items)->withOrderitems($orderItems);
        }

    }
}
