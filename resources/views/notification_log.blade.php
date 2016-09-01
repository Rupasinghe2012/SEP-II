
@extends('app')



@section('content')

    <h1>Notification Log</h1>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Notifications</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                    <thead>
                                    <tr role="row"><th class="sorting_asc" tabindex="0">Notification ID</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">Detials</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Colour: activate to sort column ascending">Status</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="price: activate to sort column ascending">Time</th> </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($notifications as $nots)

                                        <tr role="row" class="">

                                            <td>{{$nots->id}}</td>
                                            @if($nots->type== 'self-profile_update')
                                                <td>Your Profile Details has been updated</td>
                                            @elseif($nots->type== 'self-proPic_change')
                                                <td>Your Profile Picture has been changed.</td>
                                            @elseif($nots->type== 'self-password_change')
                                                <td>Your Profile password has been changed</td>
                                            @elseif($nots->type== 'self-Social')
                                                <td>Your Social profile links has been updated.</td>
                                            @endif

                                            @if($nots->read==1)
                                                <td><span class="label label-success">Read</span></td>
                                            @else
                                                <td><span class="label label-warning">Unread</span></td>
                                            @endif
                                            <td>{{$nots->diff}}</td>

                                        </tr>
                                    @endforeach
                                    {{--<tfoot>--}}
                                    {{--<tr><th rowspan="1" colspan="1">Template ID</th><th rowspan="1" colspan="1">Name</th><th rowspan="1" colspan="1">Description</th><th rowspan="1" colspan="1">Colour</th><th rowspan="1" colspan="1">Image</th></tr>--}}
                                    {{--</tfoot>--}}
                                </table></div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example2_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="example2_previous"><a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0">6</a></li><li class="paginate_button next" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0">Next</a></li></ul></div></div></div></div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@section('notifications')
    @include('includes.notification')
@stop

@endsection