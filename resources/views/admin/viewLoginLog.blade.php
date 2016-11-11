@extends('app')

@section('links')
    <link type="text/css" rel="stylesheet" href="/css/jquery.dataTables.min.css">
@stop

@section('content')
@section('pageName')
    Login Log
@stop
{{--breadcrumb--}}
@section('breadcrumbs')
    {!! Breadcrumbs::render('login-log') !!}
@stop
<div class="row col-md-12">

    <div class="row card" id="view-users-header">
    </div>

    <div class="row" id="view-users-container">
        <div class="alert alert-danger" id="view-log-errors" style="display: none">

        </div>

        <div class="box col-md-8" style="margin:10px 5px 15px 20px">
            <div class="box-header">
                <h3 class="box-title">User Login Details</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table class="table table-hover" id="view-login-logs-table">

                </table>
            </div>

        </div>
    </div>
    <div class="col-md-2"></div>
    </div>
@stop

@section('scripts')
    <script type="application/javascript" src="/js/jquery.dataTables.min.js"></script>
    <script type="application/javascript" src="/js/viewLoginLog.js"></script>
@stop