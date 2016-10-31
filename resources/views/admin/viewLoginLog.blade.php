@extends('app')

@section('links')
    <link type="text/css" rel="stylesheet" href="/css/jquery.dataTables.min.css">
@stop

@section('content')

    <div class="row card" id="view-users-header">
        <h4>View login log</h4>
    </div>
    <div class="row" id="view-users-container">
        <div class="alert alert-danger" id="view-log-errors" style="display: none">

        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                View user login record
            </div>
            <div class="panel-body">
                <table class="table table-hover" id="view-login-logs-table">

                </table>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script type="application/javascript" src="/js/jquery.dataTables.min.js"></script>
    <script type="application/javascript" src="/js/viewLoginLog.js"></script>
@stop