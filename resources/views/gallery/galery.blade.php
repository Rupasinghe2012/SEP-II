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
    My Gallery
@stop
{{--breadcrumb--}}
@section('breadcrumbs')
    {!! Breadcrumbs::render('gallery') !!}
@stop
    <script language="javascript" type="text/javascript">
        function validation(){

            var gallery_name=document.album.gallery_name.value;
            var details=document.album.details.value;




            if ((gallery_name == null) ) {
                swal("Error !!!!", "Enter a Album name.")
                return false;
            }

            else if (details == null ) {
                swal("Error !!!!", "Please enter a caption.")
                return false;
            }


            else {
                return swal("Succesfull!!!!", "Album has Created", "success")


            }

        }
    </script>

    <div class="container">
        {{--Edit Modal--}}

        @foreach($galleries as $album)
            <div id="edit" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit Album</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" method="post" action="{{url('gallery/edit/'. $album->id)}}" name="album">
                                <input type ="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="id" value="{{$album->id}}" />

                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Name of the Album</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="gallery_name" id="gallery_name" placeholder="Name of the Album" class="form-control" value="{{$album->name}}"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Caption for Album</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="details" name="details" placeholder="Enter a Caption" value="{{$album->details}}">
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button id="edit-btn" class="btn btn-success pull-right">Edit</button>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        @endforeach
        <div class="col-md-12">
            <h1><strong>My Albums.</strong></h1>
        </div>
        <hr>
        </br>
        </br>
        </br>
        <div class="row">

        <button   type="button"  class="btn pull-left btn-md btn-primary"  data-toggle="collapse" data-target="#demo" ><i class="fa fa-fw fa-plus"></i>Add a Album.</button>


        <div id="demo" class="collapse">
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-body">
                        <form class="form-horizontal" method="post" action="{{url('gallery/save')}}" name="album" onsubmit="return validation()">
                            <input type ="hidden" name="_token" value="{{csrf_token()}}">

                            <div class="form-group">
                                <label  class="col-sm-4 control-label">Name of the Album</label>
                                <div class="col-sm-8">
                                    <input type="text" name="gallery_name" id="gallery_name" placeholder="Name of the Album" class="form-control" value="{{old('gallery_name')}}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-4 control-label">Caption for Album</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="details" name="details" placeholder="Enter a Caption">
                                </div>
                            </div>
                            <button id="add-btn" class="btn btn-success pull-right">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            </div>

        <!-- Begin of rows -->
        @if($galleries->count() > 0)
            <div class="col-md-12">

                @foreach($galleries as $gallery)
                    <div class="row carousel-row">
                        <div class="col-xs-8 col-xs-offset-2 slide-row">
                            {{--<div class="carousel-inner">--}}
                            {{--<img src="{{URL::asset('resources/assets/img/x.png')}}">--}}
                            {{--</div>--}}
                            <div id="carousel-1" class="carousel slide slide-carousel" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel-1" data-slide-to="1"></li>
                                    <li data-target="#carousel-1" data-slide-to="2"></li>
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <img src="{{URL::asset('/img/v.png')}}" alt="Image">
                                    </div>
                                    <div class="item">
                                        <img src="{{URL::asset('/img/x.png')}}" alt="Image">
                                    </div>
                                    <div class="item">
                                        <img src="{{URL::asset('/img/z.png')}}" alt="Image">
                                    </div>
                                </div>
                            </div>

                            <div class="slide-content">
                                <h4><strong>{{$gallery->name}}</strong></h4>
                                <p>{{$gallery->details}}</p>
                                <div class="btn-toolbar">
                                    <a class="btn pull-left btn-md btn-default" href="
                            {{url('gallery/view/' . $gallery->id)}}" ><i class="fa fa-fw fa-eye"></i> Show</a>

                                    <a class="btn pull-right btn btn-info" href="" data-toggle="modal" data-target="#edit" ><i class="fa fa-fw fa-pencil" ></i> Edit</a>
                                    <form method="post" action="{{url('gallery/delete/'.$gallery->id)}}" class="delete_form">
                                        {{ csrf_field() }}
                                        <a  id="delete-btn" class="btn  pull-right btn-danger delete" ><i class="fa fa-fw fa-trash"></i> Delete</a>
                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>
                @endforeach
               @else
                <hr>
                        <div class="alert alert-danger">
                            <i class="fa fa-2x fa-fw fa-exclamation-triangle"></i>No Albums Ceated
                        </div>
                @endif

                <div class="col-md-4">
                    @if(count ($errors)>0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>

            </div>
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
    <link rel="stylesheet" type="text/css" itemprop="javascript" href="{{ asset('js/fancybox/jquery.fancybox.css')}}" media="all">
    <script src="{{ asset('js/fancybox/jquery.easing.1.3.js')}}"></script>
    <script src="{{ asset('js/fancybox/jquery.fancybox-1.2.1.js')}}"></script>
@stop

@endsection
