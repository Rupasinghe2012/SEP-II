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