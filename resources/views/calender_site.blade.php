@extends('app')



@section('content')
    <h3 style="text-align: center"><b>EVENT CALENDAR</b></h3>
    <div class="col-md-12">
        <div class="col-md-1"></div>
        <div class="col-md-11" style="align-items: center;">
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
                            @if($event->event_start_date == $year."-".$month."-".$i && $i==$c_day&&$year==$c_year&&$month==$c_month)
                                <div id="replyModal{{$year."-".$month."-".$i}}" class="modal fade" role="dialog" style="z-index: 1400;">
                                    <div class="modal-dialog modal-lg">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><b>EVENT LIST - </b>{{$year."-".$month."-".$i}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <button style=" background-color: #01ff70" title="" type="button" class="btn btn-default" data-toggle="modal" data-target="#test2{{$year."-".$month."-".$i}}">My Events</button>
                                                <button style=" background-color: #00d8ff" title="" type="button" class="btn btn-default" data-toggle="modal" data-target="#test3{{$year."-".$month."-".$i}}">Others' Events</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="test2{{$year."-".$month."-".$i}}" class="modal fade" role="dialog" style="z-index: 1600;">
                                    <div class="modal-dialog modal-lg">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><b>MY EVENTS - </b>{{$year."-".$month."-".$i}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                @foreach($event_list as $event)
                                                    @if($event->event_start_date == $year."-".$month."-".$i && $event->user_id == $loged_user->id)
                                                        <div style="background-color:#42dca3">
                                                            Event ID          :<b>{{$eventid = $event->id}}</b><br>
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

                                <div id="test3{{$year."-".$month."-".$i}}" class="modal fade" role="dialog" style="z-index: 1600;">
                                    <div class="modal-dialog modal-lg">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><b>OTHERS' EVENTS - </b>{{$year."-".$month."-".$i}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                @foreach($event_list as $event)
                                                    @if($event->event_start_date == $year."-".$month."-".$i && $event->user_id != $loged_user->id)
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

                            @elseif($event->event_start_date == $year."-".$month."-".$i)
                                <div id="replyModal{{$year."-".$month."-".$i}}" class="modal fade" role="dialog" style="z-index: 1400;">
                                    <div class="modal-dialog modal-lg">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><b>EVENT LIST - </b>{{$year."-".$month."-".$i}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <button style=" background-color: #01ff70" title="" type="button" class="btn btn-default" data-toggle="modal" data-target="#test2{{$year."-".$month."-".$i}}">My Events</button>
                                                <button style=" background-color: #00d8ff" title="" type="button" class="btn btn-default" data-toggle="modal" data-target="#test3{{$year."-".$month."-".$i}}">Others' Events</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="test2{{$year."-".$month."-".$i}}" class="modal fade" role="dialog" style="z-index: 1600;">
                                    <div class="modal-dialog modal-lg">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><b>MY EVENTS - </b>{{$year."-".$month."-".$i}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                @foreach($event_list as $event)
                                                    @if($event->event_start_date == $year."-".$month."-".$i && $event->user_id == $loged_user->id)
                                                        <div style="background-color:#42dca3">
                                                            Event ID          :<b>{{$event->id}}</b><br>
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


                                <div id="test3{{$year."-".$month."-".$i}}" class="modal fade" role="dialog" style="z-index: 1600;">
                                    <div class="modal-dialog modal-lg">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><b>OTHERS' EVENTS - </b>{{$year."-".$month."-".$i}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                @foreach($event_list as $event)
                                                    @if($event->event_start_date == $year."-".$month."-".$i && $event->user_id != $loged_user->id)
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


                                <?php $count++ ?><td width="100px" align="center"><button style="width: 100px; background-color: #eac36e" title="" type="button" class="btn btn-default" data-toggle="modal" data-target="#replyModal{{$year."-".$month."-".$i}}">{{$i}}</button></td>@break;
                            @endif
                        @endforeach
                        @if($count==0)
                            @if($i == $c_day&&$year == $c_year&&$month == $c_month)
                                <td width="100px" align="center"><button style="width: 100px; border: outset rgba(26, 255, 28, 1)" title="" type="button" class="btn btn-default" data-toggle="modal" data-target="#replyModal{{$year."-".$month."-".$i}}">{{$i}}</button></td>
                            @else
                                <td width="100px" align="center"><button style="width: 100px" title="" type="button" class="btn btn-default" data-toggle="modal" data-target="#replyModal{{$year."-".$month."-".$i}}">{{$i}}</button></td>
                            @endif
                        @endif
                        @endfor
                    </tr>
                </table>
            </form>
            <br><br>


        </div>
        <div class="col-md-2"></div>
    </div>
@endsection