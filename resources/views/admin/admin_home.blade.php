@extends('app')



@section('content')
@section('pageName')
    <h3 style="text-align: center"><b>ADMIN DASHBOARD</b></h3>
@stop
@section('breadcrumbs')
    {!! Breadcrumbs::render('admin-home') !!}
@stop
    <div class="col-md-12">
        <div class="col-lg-6 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?php echo $count['user'] ?></h3>
                    <p>USER REGISTERATIONS</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href={{url("/admin/user/manage") }} class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-6 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-maroon">
                <div class="inner">
                    <h3><?php echo $count['temp'] ?></h3>
                    <p>TEMPLATE COUNT</p>
                </div>
                <div class="icon">
                    <i class="fa fa-indent" aria-hidden="true"></i>
                </div>
                <a href={{url("/templates/edit")}} class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
    </div>


    <div class="col-md-12">
        <h4 style="text-align: center"><b>VISITORS' MAILS</b></h4>
        <div class="col-lg-2 col-xs-6"></div>
        <a href={{url("/templates/mail/view")}}> <div class="col-lg-4 col-xs-6">
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Replied Mails</span>
                        <span class="info-box-number"><?php echo $count['replied'] ?></span>

                        <div class="progress">
                            <div class="progress-bar" style="width: <?php if($count['mail']==0){$count['mail']=1;}else echo ($count['replied']/$count['mail'])*100 ?>%"></div>
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-lg-4 col-xs-6">
                <div class="info-box bg-lime">
                    <span class="info-box-icon"><i class="fa fa-envelope-square" aria-hidden="true"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Mail Queue</span>
                        <span class="info-box-number"><?php echo $count['queue'] ?></span>

                        <div class="progress">
                            <div class="progress-bar" style="width: <?php if($count['mail']==0){$count['mail']=1;}else  echo ($count['queue']/$count['mail'])*100 ?>%"></div>
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
        </a>
    </div>

<div class="col-md-12">
    <h4 style="text-align: center"><b>GENERATE REPORTS</b></h4>
    <div class="col-lg-1 col-xs-6"></div>
    <div class="col-lg-2 col-xs-3">
        <!-- small box -->
        <div class="small-box bg-blue-active">
            <div class="inner">

                <p>USER DETAILS</p>
                <br><br>
            </div>
            <div class="icon">
                <i class="fa fa-users" aria-hidden="true"></i>
            </div>
            <a href={{url("/reports/user")}} class="small-box-footer">View Report <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->

    <div class="col-lg-2 col-xs-3">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">

                <p>EVENT DETAILS</p>
                <br><br>
            </div>
            <div class="icon">
                <i class="fa fa-calendar"></i>
            </div>
            <a href={{url("/reports/event")}} class="small-box-footer">View Report <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->

    <div class="col-lg-2 col-xs-3">
        <!-- small box -->
        <div class="small-box bg-fuchsia">
            <div class="inner">

                <p>TEMPLATE USAGE DETAILS</p>

            </div>
            <div class="icon">
                <i class="fa fa-indent"></i>
            </div>
            <a href={{url("/reports/temp")}} class="small-box-footer">View Report <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->
    {{--<div class="col-lg-2 col-xs-6"></div>--}}
    <div class="col-lg-2 col-xs-3">
        <!-- small box -->
        <div class="small-box bg-purple">
            <div class="inner">

                <p>TEMPLATE ORDER DETAILS</p>

            </div>
            <div class="icon">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <a href={{url("preorder/reports")}} class="small-box-footer">View Report <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->

    <div class="col-lg-2 col-xs-3">
        <!-- small box -->
        <div class="small-box bg-olive">
            <div class="inner">

                <p>USER ACTIVE LOG</p>
                <br>
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
