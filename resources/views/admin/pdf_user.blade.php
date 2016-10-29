<h2 align="center">USER DETAIL REPORT</h2>
<br><br><table border="2px" style="text-align: center" width="100%">
    <tr bgcolor="#f5f5dc">
        <th style="font-size: medium;text-align: center">User ID</th>
        <th style="font-size: medium;text-align: center">User Name</th>
        <th style="font-size: medium;text-align: center">Email</th>
        <th style="font-size: medium;text-align: center">Status</th>
        <th style="font-size: medium;text-align: center">BOD</th>
        <th style="font-size: medium;text-align: center">Address</th>
        <th style="font-size: medium;text-align: center">Mobile</th>
        <th style="font-size: medium;text-align: center">User Type</th>
    </tr>
    @foreach($data as $user)
        <tr>
            <td style="font-size: small">{{$user->id}}</td>
            <td style="font-size: small">{{$user->user_name}}</td>
            <td style="font-size: small">{{$user->email}}</td>
            <td style="font-size: small">{{$user->status}}</td>
            <td style="font-size: small">{{$user->BOD}}</td>
            <td style="font-size: small">{{$user->address}}</td>
            <td style="font-size: small">{{$user->mobile}}</td>
            <td style="font-size: small">{{$user->type}}</td>
        </tr>

    @endforeach
</table>

<h4 align="center">Profiler.Net</h4>