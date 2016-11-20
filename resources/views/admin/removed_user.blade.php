@extends('app')


@section('pageName')
    <h3 style="text-align: center"><b>REMOVED USER DETAILS</b></h3>
@stop
{{--breadcrumb--}}
@section('breadcrumbs')
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/admin/home')}}">Home /</a>
        <a class="breadcrumb-item" href="{{url('/admin/user/manage')}}">User Details /</a>
        <span class="breadcrumb-item active">Removed User Details</span>
    </nav>
@stop
@section('content')
    <a href={{url("/admin/user/manage") }}><button title="click here to view present users" type="button" style="float: right;" class="btn btn-success"><i class="fa fa-list-ul" aria-hidden="true"></i><span> </span><i class="fa fa-user" aria-hidden="true"></i></button></a><div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="User ID: activate to sort column descending">User ID</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">Name</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Email</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Reason: activate to sort column ascending">Reason</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Done_by: activate to sort column ascending">Done By</th>
                                </thead>
                                <tbody>

                                @foreach($re_users as $user)
                                    <tr role="row" class="">

                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->reason }}</td>
                                        <td>{{ $user->done_by }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </table></div></div>
                    <div class="row">

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
@section('notifications')
    @include('includes.notification')
@stop

@endsection