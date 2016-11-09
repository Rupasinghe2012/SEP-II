@extends('app')
@section('pageName')
    Home
    @stop
    @section('breadcrumbs')
    {!! Breadcrumbs::render('home') !!}
    @stop

    @section('content')


    <!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-4 col-xs-7">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{$count['templates']}}</h3>
                <p>Templates</p>
            </div>
            <div class="icon">
                <i class="fa fa-envelope-o"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-4 col-xs-7">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{$count['not']}}</h3>
                <p>Notifications</p>
            </div>
            <div class="icon">
                <i class="fa fa-bell-o"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-4 col-xs-7">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{$count['post']}}</h3>
                <p>Posts</p>
            </div>
            <div class="icon">
                <i class="fa fa-comment-o"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-4 col-xs-7">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{$count['comments']}}</h3>
                <p>Comments</p>
            </div>
            <div class="icon">
                <i class="fa fa-comment-o"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-xs-7">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{$count['events']}}</h3>
                <p>Events</p>
            </div>
            <div class="icon">
                <i class="fa fa-user-plus"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-xs-7">
        <!-- small box -->
        <div class="small-box bg-aqua" >
            <div class="inner">
                <h3>{{$count['galery']}}</h3>
                <p>Galary</p>
            </div>
            <div class="icon">
                <i class="fa fa-user-plus"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-xs-7">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{$count['sites']}}</h3>
                <p>Sites</p>
            </div>
            <div class="icon">
                <i class="fa fa-user-plus"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-xs-7">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{$count['orders']}}</h3>
                <p>MyOrders</p>
            </div>
            <div class="icon">
                <i class="fa fa-user-plus"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- <div id="w"></div>
    <input type="button" value="Add" class="btn btn-primary" id="add"></input> -->

    <!-- ./col -->
</div><!-- /.row -->
<script>
    $(document).ready(function(){
        var content;
        $("#add").click(function(){
            content='<div class="col-lg-4 col-xs-7">'+
                '<div class="small-box bg-aqua">'+
                    '<div class="inner">'+
                        '<h3>{{$count['orders']}}</h3>'+
                        '<p>MyOrders</p>'+
                    '</div>'+
                    '<div class="icon">'+
                        '<i class="fa fa-user-plus"></i>'+
                    '</div>'+
                    '<a href="#" class="small-box-footer">'+
                        'More info <i class="fa fa-arrow-circle-right"></i>'+
                    '</a></div></div>';
            $("#w").append(content);
        });
    });
</script>


@section('notifications')
    @include('includes.notification')
@stop




@endsection
