@extends('app')
@section('content')

    <H1>EVENT REPORT</H1>
    <form data-parsley-validate="" class="form-horizontal" action="{{ url("/reports/event/search-download")  }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
    Event Start Date : <input type="date" name="str_date"><span> </span> Event End Date : <input type="date" name="end_date"><br><br>

        <button title="click here to add event" name="select" type="submit" class="btn btn-success" value="Search Event Details"><i class="fa fa-search" aria-hidden="true"></i><span> </span>Search Event Details</button>
        <button title="click here to add event" name="select" type="submit" class="btn btn-danger" value="Download Report"><i class="fa fa-download" aria-hidden="true"></i><span> </span>Download Report</button>



    {{--<a href={{url("/getPDF/event") }}><button name="report_user" value="download" class="btn btn-default" >Download</button></a>--}}

        @if($data!=null)
            <br><br>Events Between <input type="text" value="{{$s_date}}" name="sd" readonly> and <input type="text" value="{{$e_date}}" name="ed" readonly>
            <br><br><table border="2px" style="text-align: center" width="100%">
                <tr bgcolor="#f5f5dc">
                    <th style="font-size: medium;text-align: center">Event ID</th>
                    <th style="font-size: medium;text-align: center">User</th>
                    <th style="font-size: medium;text-align: center">Event Title</th>
                    <th style="font-size: medium;text-align: center">Event Description</th>
                    <th style="font-size: medium;text-align: center">Event Date</th>
                    <th style="font-size: medium;text-align: center">Event Time</th>
                    <th style="font-size: medium;text-align: center">Event Venue</th>
                    <th style="font-size: medium;text-align: center">Event Type</th>
                </tr>
                @foreach($data as $event)
                    <tr>
                        <td style="font-size: small">{{$event->id}}</td>
                        <td style="font-size: small">{{$event->user_id}} - {{$event->user_name}}</td>
                        <td style="font-size: small">{{$event->title}}</td>
                        <td style="font-size: small">{{$event->description}}</td>
                        <td style="font-size: small">{{$event->event_start_date}}</td>
                        <td style="font-size: small">{{$event->s_time}} - {{$event->e_time}}</td>
                        <td style="font-size: small">{{$event->venue}}</td>
                        <td style="font-size: small">{{$event->type}}</td>
                    </tr>

                @endforeach
            </table>
        @endif
    </form>

@section('notifications')
    @include('includes.notification')
@stop
@endsection