<h2 align="center">EVENTS DETAIL REPORT</h2>
@if($data!=null)
    <br><br>Events Between {{$s_date}} and {{$e_date}}
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
<h4 align="center">Profiler.Net</h4>