@extends('app')



@section('content')
    <div class="row">
        @foreach($usermail as $mail)

            <h3 style="text-align: center"><b>{{ $mail->sender_name }}</b> - < {{ $mail->sender_email }} ></h3>

        @endforeach
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">

                                    <tbody>

                                    {{--<button title="click here to create mail" type="button" class="btn btn-warning" data-toggle="modal" data-target="#replyModal"><i class="fa fa-reply" aria-hidden="true"></i></button>--}}
                                    @foreach($visitormails as $mail)

                                        <tr>
                                            <td><button title="click here to create mail" type="button" class="btn btn-warning" data-toggle="modal" data-target="#replyModal{{$mail->id}}"><i class="fa fa-reply" aria-hidden="true"></i></button><p><i>< {{ $mail->created_at }} ></i></p><h3><b><u>{{ $mail->subject }}</u></b></h3><b><p style="color: #0c0c0c"> -{{ $mail->description }}</p></b></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                @if(($mail->reply)!=null)
                                                    @foreach($a = explode("  -  updated  ->  ",$mail->reply) as $parts)
                                                        @if($parts==reset($a) && $parts==end($a))
                                                            <h4 style="text-align: right; color: #0c0c0c"><b>{{ $parts }}</b></h4>
                                                        @elseif($parts==reset($a))
                                                            <h4 style="text-align: right;">{{ $parts }}</h4>
                                                        @elseif($parts==end($a))
                                                            <h4 style="text-align: right; color: #0c0c0c">Latest Updated-><b>{{ $parts }}</b></h4>
                                                        @else
                                                            <p style="text-align: right">updated->{{ $parts }}</p>
                                                        @endif
                                                    @endforeach
                                                @endif

                                                @if($mail->reply!="not yet reply")<p style="text-align: right"><i>< {{ $mail->updated_at }} - {{ $mail->reply_by }} ></i></p>@endif</td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="replyModal{{$mail->id}}" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Type your reply</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form-horizontal" action="{{ url("templates/". $mail->id ."/reply")  }}" method="post" enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            <textarea name="reply_message" id="reply_message" class="form-control" rows="4" cols="60" placeholder="Enter your message" required="required"></textarea>
                                                            <input title="click here to reply" type="submit" class="btn btn-warning" value="Send" onclick="return confirm('Are you sure to SEND this mail?');">
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach

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