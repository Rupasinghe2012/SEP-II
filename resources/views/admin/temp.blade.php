@extends('app')
@section('content')

    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
        }

        #wrapper {
            margin: 20px auto;
            width: 960px;
        }

        h1 {
            text-align: center;
            margin: 0 0 20px;
        }

        .grid-block-container {
            float: left;
            width: 990px;
            margin: 20px 0 0 -30px;
        }
        .grid-block {
            position: relative;
            float: left;
            width: 600px;
            height: 400px;
            margin: 0 0 30px 30px;
        }
        .grid-block h4 {
            font-size: .9em;
            color: #333;
            background: #f5f5f5;
            margin: 0;
            padding: 10px;
            border: 1px solid #ddd;
        }

        .caption {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            background:url({{url('resources/assets/img/trans-black-50.jpg')}});
            width: 100%;
            height: 100%;
        }
        .caption h3, .caption p {
            color: #fff;
            margin: 20px;
        }
        .caption h3 {
            margin: 20px 20px 10px;
        }
        .caption p {
            font-size: .75em;
            line-height: 1.5em;
            margin: 0 20px 15px;
        }
        .caption a.learn-more {
            padding: 5px 10px;
            background: #08c;
            color: #fff;
            border-radius: 2px;
            -moz-border-radius: 2px;
            font-weight: bold;
            text-decoration: none;
        }
        .caption a.learn-more:hover {
            background: #fff;
            color: #08c;
        }
    </style>

    <!-- <div id="wrapper">
    <div class="grid-block-container">
        <div class="grid-block slide">
            <div class="caption">
                <h3>Caption Title</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <p><a href="{{url('/demo')}}" target="_blank" class="learn-more">Demo</a></p>
                <p><a href="{{url('/edit')}}" class="learn-more">Edit</a></p>
            </div>
            <img src="{{url('resources/assets/img/2.jpg')}}" style="width:600px;height:300px;"/>
        </div>
    </div>
</div> -->
    <div class="container-fluid">
        @foreach($template as $value=>$key)
            <div class="row">
                <div class="col-sm-6">
                    <div id="wrapper">
                        <div class="grid-block-container">
                            <div class="grid-block slide">
                                <div class="caption">
                                    <h3>Rs :{{$key['price']}}</h3>
                                    <p>{{$key['description']}}</p>
                                    <p><a href="{{url('/demo')}}" target="_blank" class="learn-more">Demo</a></p>
                                    <p><a href="{{url('/edit/'.$key["id"])}}" class="learn-more">Edit</a></p>
                                </div>
                                <img src="{{url('/images/previews/'.$key["temp_pic"])}}" style="width:600px;height:300px;"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.slide').hover(
                    function(){
                        $(this).find('.caption').slideDown(550);
                    },
                    function(){
                        $(this).find('.caption').slideUp(550);
                    }
            );
        });
    </script>



@section('notifications')
    @include('includes.notification')
@stop

@endsection
