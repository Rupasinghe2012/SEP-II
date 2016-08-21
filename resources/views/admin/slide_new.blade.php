@extends('app')



@section('content')
    <form>
        <table>
            @foreach($slideimages as $slideimage)
                <tr role="row" class="">

                    <td>{{ $slideimage->id }}</td>
                    <td>{{ $slideimage->name }}</td>
                    <td>{{ $slideimage->description }}</td>
                    <td><a href="{{ url("templates/show/" .$slideimage->id) }}" target="_blank"><img src='{{asset("/img/preview/" . $slideimage->slide_pic )  }}' alt="MountainView" style="width:100px;height:50px;"></a></td>
                    {{--<td>{{ $slideimage->status }}</td>--}}
                    {{--<td style="text-align: center"><a href={{url("templates/slide/". $slideimage->id ."/change1") }}><button title="Set for first image" type="button" class="btn btn-warning" value="1" name="first" ><i class="fa fa-picture-o" aria-hidden="true"></i></button></a></td>--}}
                    {{--<td style="text-align: center"><a href={{url("templates/slide/". $slideimage->id ."/change2") }}><button title="Set for other image" type="button" class="btn btn-info" value="2" name="second" ><i class="fa fa-picture-o" aria-hidden="true"></i><i class="fa fa-picture-o" aria-hidden="true"></i></button></a></td>--}}
                    {{--<td style="text-align: center"><a href={{url("templates/slide/". $slideimage->id ."/change3") }}><button title="Remove image from slideshow" type="button" class="btn btn-danger" value="0" name="non" ><i class="fa fa-picture-o" aria-hidden="true"></i><span> </span><i class="fa fa-share-square-o" aria-hidden="true"></i></button></a></td>--}}
                    <td><input type="checkbox" name="image.{{$slideimage->id}}" value="2"></td>
                    <td><input type="radio" name="first" value="1"></td>
                </tr>
            @endforeach
        </table>
        <input type="submit" value="submit">
    </form>
@section('notifications')
    @include('includes.notification')
@stop

@endsection