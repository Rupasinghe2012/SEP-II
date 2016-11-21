@extends('app')
@section('content')

@section('pageName')
    <h3 style="text-align: center"><b>REPORTS</b></h3>
@stop
{{--breadcrumb--}}
@section('breadcrumbs')
    {!! Breadcrumbs::render('reports') !!}
@stop


    <div class="col-md-12">
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">

                    <p>USER DETAILS</p>
                    <br><br><br><br>
                </div>
                <div class="icon">
                    <i class="fa fa-users" aria-hidden="true"></i>
                </div>
                <a href={{url("/reports/user")}} class="small-box-footer">View Report <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">

                    <p>EVENT DETAILS</p>
                    <br><br><br><br>
                </div>
                <div class="icon">
                    <i class="fa fa-calendar"></i>
                </div>
                <a href={{url("/reports/event")}} class="small-box-footer">View Report <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-lime-active">
                <div class="inner">

                    <p>TEMPLATE USAGE DETAILS</p>
                    <br><br><br><br>
                </div>
                <div class="icon">
                    <i class="fa fa-indent"></i>
                </div>
                <a href={{url("/reports/temp")}} class="small-box-footer">View Report <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-2 col-xs-6"></div>
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">

                    <p>TEMPLATE ORDER DETAILS</p>
                    <br><br><br><br>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <a href={{url("preorder/reports")}} class="small-box-footer">View Report <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">

                    <p>USER ACTIVE LOG</p>
                    <br><br><br><br>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href={{url("/admin/logs/login")}} class="small-box-footer">View Report <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
    </div>




@section('notifications')
    @include('includes.notification')
@stop
@endsection