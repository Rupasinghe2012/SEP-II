<h2 align="center">TEMPLATE FULL DETAIL REPORT</h2>
@if($data!=null)
    <H3 style="text-align: center">TEMPLATES USAGE</H3>
    <table width="100%" align='center' border='1px'>
        <tr bgcolor="#f5f5dc">
            <th style="font-size: medium; text-align: center">Template Name</th>
            <th style="font-size: medium; text-align: center">Description</th>
            <th style="font-size: medium; text-align: center">Color</th>
            <th style="font-size: medium; text-align: center">Price</th>
            <th style="font-size: medium; text-align: center">#Sales</th>
            <th style="font-size: medium; text-align: center" width="60%">Sales Chart with precentage</th>
            <th style="font-size: medium; text-align: center">Income</th>
        </tr>
        @foreach($data as $temp)
            <tr>
                <td>{{$temp->name}}</td>
                <td>{{$temp->description}}</td>
                <td bgcolor="{{$temp->colour}}">{{$temp->colour}}</td>
                <td style="text-align:center">{{$temp->price}}</td>
                <td style="text-align: center">{{$temp->x}}</td>
                <td>
                    <table border="5px" width="{{$temp->y/$tot*100}}%">
                        <tr bgcolor="#ffe4c4">
                            <td style="text-align:center" ><b>Rs:{{$temp->y}}</b>({{round($temp->y/$tot*100,2)}}%)</td>
                        </tr>
                    </table>
                </td>
                <td style="text-align: center">{{$temp->y}}</td>
            </tr>
        @endforeach

        <tr bgcolor="#add8e6">
            <td width='25%'><b>Total (Rs:)</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td  style="text-align: center"><b>{{$tot}}</b></td>
        </tr>

    </table>

    <br><br>
    <H3 style="text-align: center">TEMPLATES NEVER USED</H3>

    <table width="100%" align='center' border='1px'>
        <tr bgcolor="#f5f5dc">
            <th style="font-size: medium; text-align: center">Template Name</th>
            <th style="font-size: medium; text-align: center">Description</th>
            <th style="font-size: medium; text-align: center">Source</th>
            <th style="font-size: medium; text-align: center">Price</th>
            <th style="font-size: medium; text-align: center">Color</th>
            <th style="font-size: medium; text-align: center">Created at</th>
        </tr>
        @foreach($notin as $temp)
            <tr>
                <td>{{$temp->name}}</td>
                <td>{{$temp->description}}</td>
                <td>{{$temp->temp_source}}</td>
                <td>{{$temp->price}}</td>
                <td bgcolor="{{$temp->colour}}">{{$temp->colour}}</td>
                <td>{{$temp->created_at}}</td>
            </tr>
        @endforeach
    </table>
    @endif
    <h4 align="center">Profiler.Net</h4>