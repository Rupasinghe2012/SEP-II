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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function create()
    {
        return view('store');
    }

    /**
     * @descriptionStore a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request|Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function store(Request $request)
    {
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
     * @description Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
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
     * @description Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @description Update the specified resource in storage
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * @description Removing Templates
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function destroy($id)
    {
        try{
        $preorder = preorder::find($id);
        if (Auth::user()->type=='client')
            $preorder->status = 'cancelled';
        else
            $preorder->status = 'rejected';

        $preorder->save();
        Session::flash('message', 'Your order has been cancelled.');
        return redirect('/preorder/pending');
    }catch (\Exception $exception) {
        $exceptionData['user_id'] = $this->userId;
        $exceptionData['exception'] = $exception->getMessage();
        $exceptionData['time'] = Carbon::now()->toDateTimeString();

        ExceptionsLog::create($exceptionData);
        }
    }

    /**
     * @description Buying Templates
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    function buy($id)
    {
        try {
            $preorder = preorder::find($id);
            if (Auth::user()->type == 'client') {
                $preorder->status = 'Completed';
                $preorder->paid = '1';
            } else {
                $preorder->status = 'Completed';
                $preorder->paid = '1';
            }
            $preorder->save();
            $temp = DB::table('preorderitems')->where('preorder_id', $preorder->preorder_id)->get();

            foreach ($temp as $tid) {
                $mytemplates = new mytemplate();
                $mytemplates->userid = Auth::user()->id;
                $mytemplates->templateid = $tid->item_id;
                $mytemplates->save();
            }
            Session::flash('message', 'You have Succesfully purchased this Template');
            return redirect('/preorder/pending');

        }catch (\Exception $exception) {
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }
    }

    /**
     * @description Get Pending Orders
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function getPending()
    {
        $id = Auth::user()->id;

            $pending = preorder::pending()->where('customer_id', $id)->orderBy('updated_at', 'description')->get();

        return view('store.pending')->with('preorders', $pending);
    }

    /**
     * @description Get History
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
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

    /**
     * @param \Illuminate\Http\Request|Request $request
     * @description Search Items
     * @return  $result
     */
    public function getSearch(Request $request){
        if ($request) {
            $search=$request->input('search');
            $result=DB::table('templates')
                ->where('name','like',$search.'%')
                ->get();
            return $result;
        } else {
            return $result;
        }
    }

    /**
     * @param \Illuminate\Http\Request|Request $request
     * @description Getting All Categories
     * @return $result
     */
    public function getCategory(Request $request) {
        try{
        $category = $request->input('category');
        return '$result';
        }catch (\Exception $exception) {
        $exceptionData['user_id'] = $this->userId;
        $exceptionData['exception'] = $exception->getMessage();
        $exceptionData['time'] = Carbon::now()->toDateTimeString();

        ExceptionsLog::create($exceptionData);
        }
    }

    /**
     * @param \Illuminate\Http\Request|Request $request
     * @description Getting Items
     */
    public function getItems(Request $request) {
        try {
            if ($request) {
                $category = $request->input('category');
            }


            if ($category) {
                if ($category === 'All') {

                    $items = DB::table('templates')
                        ->select('templates.*')
                        ->get();
                    return $items;
                } else {
                    $items = DB::table('templates')
                        ->select('templates.*')
                        ->get();
                    return $items;
                }

            }
        }catch (\Exception $exception) {
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
            }
    }

    /**
     * @param \Illuminate\Http\Request|Request $request
     * @description Getting the Item info
     */
    public function getIteminfo(Request $request) {
        $item_id = $request->input('id');
        try {
            $item = DB::table('templates')
                ->where('templates.id', $item_id)
                ->get();

            return $item;
        }catch (\Exception $exception) {
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }
    }

    /**
     * @param \Illuminate\Http\Request|Request $request
     * @description Getting Added Items
     * @return string
     */
    public function getAdditem(Request $request) {
        try{
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
        }catch (\Exception $exception) {
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }
    }

    /**
     * @param \Illuminate\Http\Request|Request $request
     * @description Getting Session Items
     */
    public function getSessionitems(Request $request) {
        try{
        $sessionItems = DB::table('session_preorder')
            ->join('templates', 'session_preorder.item_id', '=', 'templates.id')
            ->select('description', 'qty', 'price')
            ->where('customer_id', Auth::user()->id)
            ->get();

        return $sessionItems;
        }catch (\Exception $exception) {
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }
    }

    /**
     * @param \Illuminate\Http\Request|Request $request
     * @return string
     * @description Empty the Cart
     */
    public function getCheckout(Request $request) {
    try{
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
    }catch (\Exception $exception) {
        $exceptionData['user_id'] = $this->userId;
        $exceptionData['exception'] = $exception->getMessage();
        $exceptionData['time'] = Carbon::now()->toDateTimeString();

        ExceptionsLog::create($exceptionData);
    }
    }

    /**
     * @param \Illuminate\Http\Request|Request $request
     * @description Empty the Cart
     */
    public function getEmptycart(Request $request) {
        try{
        $cid = Auth::user()->id;

        $sessionItems = DB::table('session_preorder')->where('customer_id', $cid)->get();

        foreach ($sessionItems as $sessionItem) {
            DB::table('templates')->where('id', $sessionItem->item_id);
        }

        DB::table('session_preorder')->where('customer_id', $cid)->delete();

        Session::flash('message', 'Cart has been cleared');
        }catch (\Exception $exception) {
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }
    }

    /**
     * @param \Illuminate\Http\Request|Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     * @description Generate Report
     */
    public function getReports(Request $request) {
        return view('store.report');
    }

    /**
     * @param \Illuminate\Http\Request|Request $request
     * @return $c
     * @description Generate Report
     */
    public function getProcessreport(Request $request) {
        try{
        $cid = Auth::user()->id;

        $choice = $request->input('choice');
        $startDate = \Carbon\Carbon::createFromFormat('Y-m-d', $request->input('startDate'));
        $endDate =  \Carbon\Carbon::createFromFormat('Y-m-d', $request->input('endDate'));
        $interval = $request->input('interval');

        switch ($choice) {
            case 'records':
                $records = preorder::where('preorders.status', '=', 'cancelled')
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
        }catch (\Exception $exception) {
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();

            ExceptionsLog::create($exceptionData);
        }
    }
    /**
     * @param $id
     * @return
     * @description Generate PDF report
     */
    public function getInvoice($id)
    {
        try {
            $data = User::all();
            $preorder = preorder::find($id);
            //$preorderItems = preorderItem::preorder($id)->get();
            $preorderItems = DB::table('preorderItems')
                ->leftJoin('templates', 'preorderItems.item_id', '=', 'templates.id')
                ->select('preorderItems.*', 'templates.description', 'templates.price')
                ->where('preorderItems.preorder_id', $id)
                ->get();
            $pdf = PDF::loadView('pdf.invoice', ['data' => $data, 'preorder' => $preorder, 'items' => $preorderItems])->setPaper('a4', 'landscape');

            return $pdf->download('Invoice.pdf');
        }catch (\Exception $exception){
            $exceptionData['user_id'] = $this->userId;
            $exceptionData['exception'] = $exception->getMessage();
            $exceptionData['time'] = Carbon::now()->toDateTimeString();
            ExceptionsLog::create($exceptionData);
        }
    }
}
