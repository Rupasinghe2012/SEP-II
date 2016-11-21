@extends('app')


@section('pageName')
    <h3 style="text-align: center"><b>MAIL INBOX</b></h3>
@stop
{{--breadcrumb--}}
@section('breadcrumbs')
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/admin/home')}}">Home /</a>
        <span class="breadcrumb-item active">Mail Inbox</span>
    </nav>
@stop
@section('content')
    <div class="row">

        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                    <thead>
                                    <tr role="row"><th></th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Sender Name: activate to sort column ascending">Sender Name</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Sender Mail: activate to sort column ascending">Sender Mail</th> <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Subject: activate to sort column ascending">Subject</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Messenge: activate to sort column ascending">Messenge</th></tr>
                                    </thead>
                                    <tbody>

                                    @foreach($allmail as $mail)

                                        <tr>

                                            {{--<td>{{ $mail->id }}</td>--}}
                                            @if(($mail->view_status)==0)<td><p style="background-color: #00aeef; text-align: center" ><i class="fa fa-envelope fa-2x" aria-hidden="true"></i></p></td>
                                            @elseif(($mail->view_status)==1 && $mail->reply=="not yet reply")<td><p style="text-align: center" ><i class="fa fa-envelope fa-2x" aria-hidden="true"></i></p></td>
                                            @else<td><p style="text-align: center" ><i class="fa fa-envelope-o fa-2x" aria-hidden="true"></i></p></td>
                                            @endif
                                            <td>{{ $mail->sender_name }}</td>
                                            <td>{{ $mail->sender_email }}</td>
                                            <td>{{ $mail->subject }}</td>
                                            <td>{{ $mail->description }}</td>
                                            <td style="text-align: center"><a href={{url("templates/". $mail->id ."/show") }}><button title="click here to view mail" type="button" class="btn btn-danger">view</button></a></td>
                                        </tr>

                                    @endforeach

                                </table></div></div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="dataTables_info" id="example2_info" role="status" aria-live="polite"></div>
                            </div>
                            <div class="col-sm-7">
                                <div>
                                    {{$allmail->render()}}
                                </div>
                            </div></div></div></div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>


    </div>

@section('notifications')
    @include('includes.notification')
@stop

@endsection