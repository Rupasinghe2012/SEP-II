
@extends('app')



    @section('content')
@section('pageName')
    <h3 style="text-align: center"><b>TEMPLATE ORDER DETAILS</b></h3>
    @stop
    {{--breadcrumb--}}
    @section('breadcrumbs')
    {!! Breadcrumbs::render('Temp-reports') !!}
    @stop
    @section('notifications')
    @include('includes.notification')
    @stop
            <!-- Display any messages from Session Flash -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    @if (Session::has('error-message'))
        <div class="alert alert-danger">{{ Session::get('error-message') }}</div>
    @endif

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><b>Generate report</b></div>
            <div class="panel-body">
                <div class="col-lg-2">
                    <form class="form-inline">
                        <div class="form-group">
                            <label for="startDate">Start</label>
                            <input type="date" class="form-control" name="startDate" id="startDate">
                        </div>
                        <div class="form-group">
                            <label for="endDate">End</label>
                            <input type="date" class="form-control"  name="endDate" id="endDate">
                        </div>
                    </form>
                </div>
                <div class="col-lg-2 col-lg-offset-1">
                    <form class="form-inline">
                        <div class="form-group">
                            <!--
                            <label for="interval">Interval</label>
                            <select class="form-control" id="interval">
                              <option value="Daily">Daily</option>
                              <option value="Weekly">Weekly</option>
                              <option value="Monthly">Monthly</option>
                              <option value="Yearly">Yearly</option>
                          </select>
                      -->
                        </div>
                    </form>

                </div>
                <div class="col-lg-3 col-lg-offset-1">
                    <div class="radio">
                        <label><input type="radio" name="choice" value="records">Rejected preorders</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="choice" value="means">Average time to complete preorder</label>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="ajax-loader" style='display:none;'></div>
                    </div>
                    <div class="col-lg-6">
                        <p id="error-container" class="text-danger">
                        </p>
                    </div>
                    <div class="col-lg-offset-8">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button id="btnGenerate" class="btn btn-default" onclick="generateReport();">Generate</button>
                        <button id="btnDownload" class="btn btn-primary disabled" onclick="downloadReport();">Download</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="anonymiser" class="hidden">
        <div id="pdfReport" style="width:800px; margin:0 auto;">
            <h1>Preorders Report</h1><h4>Generated {{ \Carbon\Carbon::now() }}</h4>
            <div id="pdfContent">
                <div id="chart" style="height:250px;width:500px"></div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @parent
    <link rel="stylesheet" href="/charts/morris.css">
    <script src="{{ URL::asset('/charts/jquery-2.0.0.js') }}"></script>
    <script src="{{ URL::asset('/charts/raphael-min.js') }}"></script>
    <script src="{{ URL::asset('/charts/morris.min.js') }}"></script>

    <script src="{{ URL::asset('/charts/xepOnline.jqPlugin.js') }}"></script>



    <script src="{{ URL::asset('js/preorder_reports.js') }}"></script>



@endsection