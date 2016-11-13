<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\preorder;
use App\preorderItem;
use App\Template;
use App\User;
use PDF;
use App\mytemplate;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;
use App\ExceptionsLog;
use App\Http\Requests;

class StoreController extends Controller
{
    private $userId;
    public function __construct()
    {
        $this->userId = Auth::user()->id;
    }

    /**
     * @param null $category
     * @return mixed
     */
    public function index($category=NULL)
    {


            $orderItems = DB::table('session_preorder')
                ->where('customer_id', Auth::user()->id)
                ->count();


        if ($category) {


        }
        else {
            $category='All';
            $items = DB::table('templates')->get();

            return view('store.store')->withCategory($category)->withItems($items)->withOrderitems($orderItems);
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        /*
        if ($request->input('description')=='') {
            Session::flash('error-message', 'Order was not placed. If the problem persists, please contact staff.');
            return redirect('preorder/pending');
        }
        */

        $validate_preorder = Validator::make(
            [],
            []
        );

        $preorder = new preorder;

        $created = $preorder->create($request->all());

        Session::flash('message', 'Your order has been placed!');
        return redirect('store.store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        $preorder = preorder::find($id);
        //$preorderItems = preorderItem::preorder($id)->get();
        $preorderItems = DB::table('preorderItems')
            ->leftJoin('templates', 'preorderItems.item_id', '=', 'templates.id')
            ->select('preorderItems.*', 'templates.description', 'templates.price')
            ->where('preorderItems.preorder_id', $id)
            ->get();

        return view('store.one')->withPreorder($preorder)->withItems($preorderItems);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $preorder = preorder::find($id);
        if (Auth::user()->type=='client')
            $preorder->status = 'cancelled';
        else
            $preorder->status = 'rejected';

        $preorder->save();
        Session::flash('message', 'Your order has been cancelled.');
        return redirect('/preorder/pending');
    }
    /**
     *Buy the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function buy($id)
    {
        $preorder = preorder::find($id);
        if (Auth::user()->type=='client') {
            $preorder->status = 'Completed';
            $preorder->paid = '1';
        }
        else{
            $preorder->status = 'Completed';
            $preorder->paid = '1';
        }
        $preorder->save();
        $temp = DB::table('preorderitems')->where('preorder_id', $preorder->preorder_id)->get();

        foreach ($temp as $tid){
            $mytemplates= new mytemplate();
            $mytemplates->userid=Auth::user()->id;
            $mytemplates->templateid=$tid->item_id;
            $mytemplates->save();
        }



        Session::flash('message', 'You have Succesfully purchased this Template');
        return redirect('/preorder/pending');
    }
    /**
     * Display pending orders
     *
     * @return Response
     */
    public function getPending()
    {
        $id = Auth::user()->id;

            $pending = preorder::pending()->where('customer_id', $id)->orderBy('updated_at', 'description')->get();

        return view('store.pending')->with('preorders', $pending);
    }

    /**
     * Display order history
     *
     * @return Response
     */
    public function getHistory()
    {
        $cid = Auth::user()->id;
        $role = Session::get('role');

        if ($role == 'Admin' || $role == 'Manager' || $role == 'Salesperson') {
            $history = preorder::history()->get();
        } else {
            $history = preorder::history()->where('customer_id', $cid)->orderBy('updated_at')->get();
        }

        return view('store.store')->with('preorders', $history);
    }

    // Return search for items

    public function getSearch(Request $request){
        if ($request) {
            $search=$request->input('search');
            $result=DB::table('templates')
                ->select('templates.*')
                ->get();
            //return array($search, 'Item2', 'Item3', 'Item4', 'Item5');
            return $result;
        } else {
            return $result;
        }
    }

    public function getCategory(Request $request) {
        $category = $request->input('category');
        //$result = DB::table('item_details')->where('item_category','like',$category)->get();
        return '$result';
    }

    public function getItems(Request $request) {
        if ($request) {
            $category = $request->input('category');
        }


        if ($category) {

            if ($category === 'All') {
                
                $items = DB::table('templates')
                    ->select('templates.*')
                    ->get();
                return $items;
            }

            else {
                $items = DB::table('templates')
                    ->select('templates.*')
                    ->get();
                return $items;
            }
        }
    }

    public function getIteminfo(Request $request) {
        $item_id = $request->input('id');

        $item = DB::table('templates')
            ->where('templates.id', $item_id)
            ->get();

        return $item;
    }

    public function getAdditem(Request $request) {

        $cid = Auth::user()->id;
        $id = $request->input('id');
        $qty = $request->input('qty');

        //Decrement from item table
        DB::table('templates')->where('id', $id);

        $sessionTable = DB::table('session_preorder')->where(
            ['customer_id' =>Auth::user()->id,
                'item_id' => $id])->first();

        if ($sessionTable) {
            DB::table('session_preorder')->where(['customer_id'=>$cid,'item_id'=>$id])->increment('qty', $qty);
        } else {
            DB::table('session_preorder')->insert([
                'customer_id' =>Auth::user()->id ,//session()->get('customer_id'),
                'item_id' => $id,
                'qty' => $qty
            ]);
        }

        Session::flash('message', 'Item added to order');

        return 'success';
    }

    public function getSessionitems(Request $request) {
        $sessionItems = DB::table('session_preorder')
            ->join('templates', 'session_preorder.item_id', '=', 'templates.id')
            ->select('description', 'qty', 'price')
            ->where('customer_id', Auth::user()->id)
            ->get();

        return $sessionItems;
    }

    public function getCheckout(Request $request) {

        $description = $request->input('description', 'No remarks.');
        $sessionPreorderItems = DB::table('session_preorder')->where('customer_id', Auth::user()->id)->get();

        if (empty($sessionPreorderItems)) {
            Session::flash('error-message', 'You have not added any items!');
            return 'failure';
        }

        $preorder = new preorder();
        $preorder->customer_id = Auth::user()->id;
        $preorder->description = $description;
        $preorder->save();
        $preorder_id = $preorder->preorder_id;

        $preorder_value = 0.0;

        foreach ($sessionPreorderItems as $sessionPreorderItem) {

            $preorderItem = new preorderItem();

            $preorderItem->item_id = $sessionPreorderItem->item_id;
            $preorderItem->qty = $sessionPreorderItem->qty;
            $preorderItem->preorder_id = $preorder_id;

            $preorderItem->save();

            $preorder_value += $preorderItem->qty * $preorderItem->uvalue;
        }

        $preorder->value = $preorder_value;
        $preorder->save();

        DB::table('session_preorder')->where('customer_id', Auth::user()->id)->delete();

        Session::flash('message', 'Your order has been placed');

        return 'success';

    }

    public function getEmptycart(Request $request) {
        $cid = Auth::user()->id;

        $sessionItems = DB::table('session_preorder')->where('customer_id', $cid)->get();

        foreach ($sessionItems as $sessionItem) {
            DB::table('templates')->where('id', $sessionItem->item_id);
        }

        DB::table('session_preorder')->where('customer_id', $cid)->delete();

        Session::flash('message', 'Cart has been cleared');
    }

    public function getReports(Request $request) {


        return view('store.report');
    }

    public function getProcessreport(Request $request) {
        $cid = Auth::user()->id;

        $choice = $request->input('choice');
        $startDate = \Carbon\Carbon::createFromFormat('Y-m-d', $request->input('startDate'));
        $endDate =  \Carbon\Carbon::createFromFormat('Y-m-d', $request->input('endDate'));
        $interval = $request->input('interval');

        switch ($choice) {
            case 'records':
                $records = preorder::where('preorders.status', '=', 'rejected')
                    ->leftJoin('users', 'users.id', '=', 'preorders.customer_id')
                    ->whereBetween('updated_at', array($startDate, $endDate))
                    ->get();
                return $records;
                break;
            case 'means':
                $completed_avg = preorder::completed()
                    ->whereBetween('updated_at', array($startDate, $endDate))
                    ->avg('value');
                $completed_count = preorder::completed()
                    ->whereBetween('updated_at', array($startDate, $endDate))
                    ->count();
                $cancelled_avg = preorder::cancelled()
                    ->whereBetween('updated_at', array($startDate, $endDate))
                    ->avg('value');
                $cancelled_count = preorder::cancelled()
                    ->whereBetween('updated_at', array($startDate, $endDate))
                    ->count();
                $rejected_avg = preorder::rejected()
                    ->whereBetween('updated_at', array($startDate, $endDate))
                    ->avg('value');
                $rejected_count = preorder::rejected()
                    ->whereBetween('updated_at', array($startDate, $endDate))
                    ->count();
                $pending_avg = preorder::pending()
                    ->whereBetween('updated_at', array($startDate, $endDate))
                    ->avg('value');
                $pending_count = preorder::pending()
                    ->whereBetween('updated_at', array($startDate, $endDate))
                    ->count();
                $c = [
                    [  'a' => $completed_avg, 'b' => $completed_count],
                    [  'a' => $cancelled_avg, 'b' => $cancelled_count],
                    [  'a' => $rejected_avg, 'b' => $rejected_count],
                    [  'a' => $pending_avg, 'b' => $pending_count],
                ];
                return ($c);
                break;
        }

        return $request;
    }

    public function getInvoice($id)
    {
        $data = User::all();
        $preorder = preorder::find($id);
        //$preorderItems = preorderItem::preorder($id)->get();
        $preorderItems = DB::table('preorderItems')
            ->leftJoin('templates', 'preorderItems.item_id', '=', 'templates.id')
            ->select('preorderItems.*', 'templates.description', 'templates.price')
            ->where('preorderItems.preorder_id', $id)
            ->get();
        $pdf = PDF::loadView('pdf.invoice',['data'=>$data,'preorder'=>$preorder,'items'=>$preorderItems])->setPaper('a4', 'landscape');


        return $pdf->download('Invoice.pdf');
    }
}
