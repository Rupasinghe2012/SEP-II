@extends('app')



@section('content')
@section('pageName')
    Admins Dashboard
@stop
{{--breadcrumb--}}
@section('breadcrumbs')
    {!! Breadcrumbs::render('admin-home') !!}
@stop
    <div class="col-md-12">
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?php echo $count['user'] ?></h3>
                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href={{url("/admin/user/manage") }} class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3><?php echo $count['temp'] ?></h3>
                    <p>Template Count</p>
                </div>
                <div class="icon">
                    <i class="fa fa-indent" aria-hidden="true"></i>
                </div>
                <a href={{url("/templates/edit")}} class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
    </div>


    <div class="col-md-12">
        <h3>Visitor Mails</h3>
        <a href={{url("/templates/mail/view")}}> <div class="col-lg-4 col-xs-6">
                <div class="info-box bg-green">
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
                <div class="info-box bg-yellow">
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
    </div>
@section('notifications')
    @include('includes.notification')
@stop

@endsection
