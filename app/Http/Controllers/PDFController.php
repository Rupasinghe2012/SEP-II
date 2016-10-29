<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use PDF;
use App\User;
use App\calenderevent;
use Illuminate\Support\Facades\Input;
use App\Site;
use App\Template;
use DB;

class PDFController extends Controller
{
    public function report_user()
    {
        $data = User::all();
        return view('admin.pdf_view_user',compact('data'));
    }

    public function getPDF_user()
    {
        $data = User::all();
        $pdf = PDF::loadView('admin/pdf_user',['data'=>$data])->setPaper('a4', 'landscape');
        return $pdf->download('user.pdf');
    }

    public function report_event()
    {
        $data = null;
        return view('admin.pdf_view_event',compact('data'));
    }
    
    public function report_event_search(){

        $s_date = Input::get('str_date');
        $e_date = Input::get('end_date');
        $btn = Input::get('select');
        if($btn == 'Search Event Details')
        {
            $data = calenderevent::whereBetween('event_start_date', array($s_date, $e_date))->get();
            return view('admin.pdf_view_event',compact('data','s_date','e_date'));

        }

        if($btn == 'Download Report')
        {
            if($s_date == null || $e_date == null)
            {
                $s_date = Input::get('sd');
                $e_date = Input::get('ed');
            }
            $data = calenderevent::whereBetween('event_start_date', array($s_date, $e_date))->get();
            $pdf = PDF::loadView('admin/pdf_event',['data'=>$data,'s_date'=>$s_date,'e_date'=>$e_date])->setPaper('a4', 'landscape');
            return $pdf->download('event.pdf');

        }

    }

    public function report_temp()
    {
        $data = null;
        return view('admin.pdf_view_temp',compact('data'));
    }

    public function report_temp_search(){

        $option = Input::get('option');
        $btn = Input::get('select');
        $data = null;
        if($btn == 'Search Template Details')
        {
            if($option == 'All templates')
            {
                $data =  DB::table('templates')
                    ->select('templates.*',DB::raw('count(sites.templatename)as x'),DB::raw('templates.price * count(sites.templatename) as y'))
                    ->Join('sites', 'templates.name', '=', 'sites.templatename')
                    ->groupby('templates.name')
                    ->get();
                
                $tot = 0;
                foreach ($data as $i)
                {
                    $tot+=$i->y;
                }

                $notin = Template::wherenotin('name',function($query){ $query->selectRaw('templatename')->from('sites')->groupby('templatename');})->get();
                return view('admin.pdf_view_temp',compact('data','option','notin','tot'));
            }
            
            else
            {
                return view('admin.pdf_view_temp',compact('data'));
            }
        }

        if($btn == 'Download Report')
        {
            if($option == null)
            {
                $option = Input::get('opt');
            }
            if($option == 'All templates')
            {
                $data =  DB::table('templates')
                    ->select('templates.*',DB::raw('count(sites.templatename)as x'),DB::raw('templates.price * count(sites.templatename) as y'))
                    ->Join('sites', 'templates.name', '=', 'sites.templatename')
                    ->groupby('templates.name')
                    ->get();

                $tot = 0;
                foreach ($data as $i)
                {
                    $tot+=$i->y;
                }

                $notin = Template::wherenotin('name',function($query){ $query->selectRaw('templatename')->from('sites')->groupby('templatename');})->get();

                $pdf = PDF::loadView('admin/pdf_temp',['data'=>$data,'tot'=>$tot,'notin'=>$notin])->setPaper('a4', 'landscape');
                return $pdf->download('temp_full.pdf');
                
            }
            else
            {
                return view('admin.pdf_view_temp',compact('data'));
            }
        }
        

    }

}
