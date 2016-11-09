@extends('app')

{{--css--}}
@section('links')
        <!-- galery style -->
<link rel="stylesheet" href="{{ asset('/css/galery.css') }}">
<link rel="stylesheet" href="{{ asset('/css/parsley.css') }}">
<link rel="stylesheet" href="{{ asset('/css/donut_chart.css') }}">
<link rel="stylesheet" href="{{ asset('/css/lightbox.css') }}">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css" >
@stop

@section('content')
@section('pageName')
   Album Photos
@stop
{{--breadcrumb--}}
@section('breadcrumbs')

    {!! Breadcrumbs::render('album',$gallery->id) !!}
@stop
    <style type="text/css">
        #gallery-images img{
            width: 240px;
            height: 160px;
            border: 2px solid black;
            margin-bottom: 10px;
        }
        #gallery-images ul{
            margin: 0;
            padding: 0;
        }

        #gallery-images li{
            margin: 0;
            padding: 0;
            list-style: none;
            float: left;
            padding-right: 10px;
        }
    </style>



    <div class="row">
        <div class="col-md-6">
            <h1>{{$gallery->name}}</h1>
        </div>
        <div class="col-md-6">
            <a  href="{{url('gallery/list')}}" class="btn  pull-right btn-info" ><i class="fa fa-fw fa-backward"></i>Back to Albums.</a>
        </div>
    </div>




    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <div id="gallery-images">
                        <ul>
                            @forelse($gallery->images as $image)
                                <li>
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                    <a href="{{url($image->file_path)}}" data-lightbox="mygallery">
                                        <img src="{{url('/gallery/images/thumbs/'.$image->file_name)}}">
                                    </a>
                                    <form method="post" action="{{url('gallery/deleteImg/' . $image->id)}}" class="delete_form2">
                                        {{ csrf_field() }}
                                        {{--<a  id="delete-btn" class="btn  btn-danger delete" ><i class="fa fa-fw fa-trash"></i> Delete</a>--}}
                                        <a id="delete-btn2"><button style="border-radius: 50%;"  type="button" class="btn btn-default" ><i class="fa fa-fw fa-trash" ></i></button></a>
                                    </form>
                                    </div>
                                </div>
                                </li>
                            @empty
                                <div class="alert alert-danger">
                                    <i class="fa fa-2x fa-fw fa-exclamation-triangle"></i>No Images in the Album
                                </div>
                            @endforelse

                        </ul>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-sm-8 ">
            <form action="{{url('image/do-upload')}}" class="dropzone" id="addImages">
                {{csrf_field()}}
                <input type="hidden" name="gallery_id" value="{{$gallery->id}}" >
            </form>
        </div>

    </div>

@section('notifications')
    @include('includes.notification')
@stop
{{--scripts--}}
@section('scripts')
        <!-- Galery -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>

    <script src="{{ asset('/js/galery.js')}}"></script>
    <script src="{{ asset('/js/parsley.min.js')}}"></script>
    <script src="{{ asset('/js/lightbox.js')}}"></script>

    <!-- get fancybox -->
    <link rel="stylesheet" type="text/css" itemprop="javascript" href="{{ asset('/js/fancybox/jquery.fancybox.css')}}" media="all">
    <script src="{{ asset('/js/fancybox/jquery.easing.1.3.js')}}"></script>
    <script src="{{ asset('/js/fancybox/jquery.fancybox-1.2.1.js')}}"></script>
@stop
@endsection