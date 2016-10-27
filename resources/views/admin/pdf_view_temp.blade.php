@extends('app')
@section('content')

    <H1>TEMPLATE USAGE REPORT</H1>
    <form data-parsley-validate="" class="form-horizontal" action="{{ url("/reports/temp/search-download")  }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        Search Option : <select name="option">
            <option value=""></option>
            <option value="All templates">All templates</option>
            <option value="Leastly used template">Leastly used template</option>
            <option value="Mostly used template">Mostly used template</option>
        </select><br><br>
        <button title="click here to add event" name="select" type="submit" class="btn btn-success" value="Search Template Details"><i class="fa fa-search" aria-hidden="true"></i><span> </span>Search Template Details</button>
        <button title="click here to add event" name="select" type="submit" class="btn btn-danger" value="Download Report"><i class="fa fa-download" aria-hidden="true"></i><span> </span>Download Report</button>



        {{--<a href={{url("/getPDF/event") }}><button name="report_user" value="download" class="btn btn-default" >Download</button></a>--}}

        @if($data!=null)
            <br><br>Selected Option <input type="text" value="{{$option}}" name="opt" readonly>
            <br><br><H3 style="text-align: center">TEMPLATES USAGE</H3>
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
    </form>

@section('notifications')
    @include('includes.notification')
@stop
@endsection