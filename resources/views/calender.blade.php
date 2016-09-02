@extends('app')



@section('content')
    <h3 style="text-align: center">Event Calender</h3>
    <div class="col-md-12">
        <div class="col-md-1"></div>
        <div class="col-md-8" style="align-items: center;">
            <form name="calender" action="{{ url('/calender/view')  }}" method="post">
                {{csrf_field()}}
                <input style="background-color: #ea716e" class="btn btn-default" align="center" type="submit" name="change" value="TODAY">

                <table border="1" style="border: inset rgba(59, 59, 59, 0.49); height: 100%">
                    <tr style="background-color: #4e5154">
                        <td align="center"><input type="submit" name="change" value="PREVIOUS"></td>
                        <b><td colspan="5" align="center"><input style="text-align: center" type="text" name="month_num" value="{{$month}}" readonly><input style="text-align: center" type="text" name="month" value="{{$data['month_name']}}" readonly><input style="text-align: center" type="text" name="year" value="{{$data['year']}}" readonly></td></b>
                        <td align="center"><input type="submit" name="change" value="NEXT"></td>

                    </tr>
                    <tr style="background-color: #02cbdf"><b>
                            <td width="100px" align="center">SUN</td>
                            <td width="100px" align="center">MON</td>
                            <td width="100px" align="center">TUE</td>
                            <td width="100px" align="center">WED</td>
                            <td width="100px" align="center">THR</td>
                            <td width="100px" align="center">FRI</td>
                            <td width="100px" align="center">SAT</td>
                        </b></tr>
                    <tr style="height: 50px">
                        @for($i = 1;$i<$data['num_days']+1;$i++,$data['count']++)
                            @if($i == 1)
                                @for($j = 0;$j<date("w",strtotime("$year-$month-$i"));$j++,$data['count']++)
                                    <td>&nbsp;</td>
                                @endfor
                            @endif
                            @if($data['count']%7==0)
                    </tr><tr style="height: 50px">
                        @endif
                        <?php $count=0;if($i<10){$i="0".$i;} ?>

                        @foreach($event_list as $event)
                            @if($event->event_date == $year."-".$month."-".$i && $i==$c_day&&$year==$c_year&&$month==$c_month)
                                <div id="replyModal{{$year."-".$month."-".$i}}" class="modal fade" role="dialog" style="z-index: 1400;">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><b>EVENT LIST - </b>{{$year."-".$month."-".$i}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <button style=" background-color: #01ff70" title="click here to add event" type="button" class="btn btn-default" data-toggle="modal" data-target="#test2">My Events</button>
                                                <button style=" background-color: #00d8ff" title="click here to add event" type="button" class="btn btn-default" data-toggle="modal" data-target="#test3">Others' Events</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="test2" class="modal fade" role="dialog" style="z-index: 1600;">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><b>MY EVENTS - </b>{{$year."-".$month."-".$i}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                @foreach($event_list as $event)
                                                    @if($event->event_date == $year."-".$month."-".$i && $event->user_id == $loged_user->id)
                                                        <div style="background-color:#42dca3">
                                                            Event Owner       : <b style="font-size: small;text-transform: uppercase">{{$event->user_name}}</b><br>
                                                            <button type="button" style="float: right" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button>
                                                            <button type="button" style="float: right" class="btn btn-warning"  data-toggle="modal" data-target="#test4{{$event->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                            Event Title       : <b style="font-size: large;text-transform: capitalize">{{$event->title}}</b> <br>
                                                            Event Description : <b style="word-wrap: break-word">{{$event->description}}</b><br>
                                                            Event Time :  <b style="word-wrap: break-word">{{$event->s_time}}H - {{$event->e_time}}H</b><br>
                                                            Event Venue : <b style="word-wrap: break-word">{{$event->venue}}</b><br>
                                                        </div>
                                                        <br>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="test3" class="modal fade" role="dialog" style="z-index: 1600;">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><b>OTHERS' EVENTS - </b>{{$year."-".$month."-".$i}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                @foreach($event_list as $event)
                                                    @if($event->event_date == $year."-".$month."-".$i && $event->user_id != $loged_user->id)
                                                        <div style="background-color:#7adddd">
                                                            Event Owner       : <b style="font-size: small;text-transform: uppercase">{{$event->user_name}}</b><br>
                                                            Event Title       : <b style="font-size: large;text-transform: capitalize">{{$event->title}}</b> <br>
                                                            Event Description : <b style="word-wrap: break-word">{{$event->description}}</b><br>
                                                            Event Time :  <b style="word-wrap: break-word">{{$event->s_time}}H - {{$event->e_time}}H</b><br>
                                                            Event Venue : <b style="word-wrap: break-word">{{$event->venue}}</b><br>
                                                        </div>
                                                        <br>
                                                    @endif
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $count++ ?><td width="100px" align="center"><button style="width: 100px;border: outset rgba(26, 255, 28, 1); background-color: #eac36e" title="click here to add event" type="button" class="btn btn-default" data-toggle="modal" data-target="#replyModal{{$year."-".$month."-".$i}}">{{$i}}</button></td>@break;

                            @elseif($event->event_date == $year."-".$month."-".$i)
                                <div id="replyModal{{$year."-".$month."-".$i}}" class="modal fade" role="dialog" style="z-index: 1400;">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><b>EVENT LIST - </b>{{$year."-".$month."-".$i}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <button style=" background-color: #01ff70" title="click here to add event" type="button" class="btn btn-default" data-toggle="modal" data-target="#test2">My Events</button>
                                                <button style=" background-color: #00d8ff" title="click here to add event" type="button" class="btn btn-default" data-toggle="modal" data-target="#test3">Others' Events</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="test2" class="modal fade" role="dialog" style="z-index: 1600;">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><b>MY EVENTS - </b>{{$year."-".$month."-".$i}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                @foreach($event_list as $event)
                                                    @if($event->event_date == $year."-".$month."-".$i && $event->user_id == $loged_user->id)
                                                        <div style="background-color:#42dca3">
                                                            Event Owner       : <b style="font-size: small;text-transform: uppercase">{{$event->user_name}}</b><br>
                                                            <button type="button" style="float: right" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button>
                                                            <button type="button" style="float: right" class="btn btn-warning"  data-toggle="modal" data-target="#test4{{$event->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                            Event Title       : <b style="font-size: large;text-transform: capitalize">{{$event->title}}</b> <br>
                                                            Event Description : <b style="word-wrap: break-word">{{$event->description}}</b><br>
                                                            Event Time :  <b style="word-wrap: break-word">{{$event->s_time}}H - {{$event->e_time}}H</b><br>
                                                            Event Venue : <b style="word-wrap: break-word">{{$event->venue}}</b><br>
                                                        </div>
                                                        <br>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="test3" class="modal fade" role="dialog" style="z-index: 1600;">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><b>OTHERS' EVENTS - </b>{{$year."-".$month."-".$i}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                @foreach($event_list as $event)
                                                    @if($event->event_date == $year."-".$month."-".$i && $event->user_id != $loged_user->id)
                                                        <div style="background-color:#7adddd">
                                                            Event Owner       : <b style="font-size: small;text-transform: uppercase">{{$event->user_name}}</b><br>
                                                            Event Title       : <b style="font-size: large;text-transform: capitalize">{{$event->title}}</b> <br>
                                                            Event Description : <b style="word-wrap: break-word">{{$event->description}}</b><br>
                                                            Event Time :  <b style="word-wrap: break-word">{{$event->s_time}}H - {{$event->e_time}}H</b><br>
                                                            Event Venue : <b style="word-wrap: break-word">{{$event->venue}}</b><br>
                                                        </div>
                                                        <br>
                                                    @endif
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $count++ ?><td width="100px" align="center"><button style="width: 100px; background-color: #eac36e" title="click here to add event" type="button" class="btn btn-default" data-toggle="modal" data-target="#replyModal{{$year."-".$month."-".$i}}">{{$i}}</button></td>@break;
                            @endif
                        @endforeach
                        @if($count==0)
                            @if($i == $c_day&&$year == $c_year&&$month == $c_month)
                                <td width="100px" align="center"><button style="width: 100px; border: outset rgba(26, 255, 28, 1)" title="click here to add event" type="button" class="btn btn-default" data-toggle="modal" data-target="#replyModal{{$year."-".$month."-".$i}}">{{$i}}</button></td>
                            @else
                                <td width="100px" align="center"><button style="width: 100px" title="click here to add event" type="button" class="btn btn-default" data-toggle="modal" data-target="#replyModal{{$year."-".$month."-".$i}}">{{$i}}</button></td>
                            @endif
                        @endif
                        @endfor
                    </tr>
                </table>
            </form>
            <br><br>
            <form>
                <div>
                    <input style="width: 200px" type="button" value="Add event" class="btn btn-success" data-toggle="modal" data-target="#addeventModal">
                </div>
            </form>
            <!-- Modal -->
            <div class="modal fade" id="addeventModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add Event</h4>
                        </div>
                        <div class="modal-body">
                            <form data-parsley-validate="" class="form-horizontal" action="{{ url("/calender/add_event")  }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                Event Title : <input type="text" name="title" required data-parsley-maxlength="20" data-parsley-maxlength-message="Name should be less than 20 characters"><br><br>
                                Event Details : <textarea name="details" id="details" class="form-control" rows="3" cols="20" placeholder="Enter your event details" required data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="75" data-parsley-minlength-message="description should be atleast 20 characters"  data-parsley-maxlength-message="description should be less than 75 characters"></textarea><br><br>
                                Event Date : <input type="date" name="date" required ><br><br>
                                Event Start Time : <input type="time" name="str_time" required><span> </span>Event End Time : <input type="time" name="end_time" required><br><br>
                                Event Venue : <input type="text" name="venue" required data-parsley-maxlength="20" data-parsley-maxlength-message="Name should be less than 20 characters"><br><br>
                                Event Repeat : <select>
                                    <option>Once</option>
                                    <option>Weekly</option>
                                    <option>Monthly</option>
                                </select><br><br>
                                No of Repeats : <select>
                                    <option>01</option>
                                    <option>02</option>
                                    <option>03</option>
                                    <option>04</option>
                                    <option>05</option>
                                </select><br><br><br>
                                <input title="click here to add event" type="submit" class="btn btn-warning" value="Add Event" onclick="return confirm('Are you sure to Add this event?');">
                            </form>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
@section('notifications')
    @include('includes.notification')
@stop
@endsection