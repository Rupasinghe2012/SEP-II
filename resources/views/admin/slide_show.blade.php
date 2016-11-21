@extends('app')


@section('pageName')
    <h3 style="text-align: center"><b>ADD SLIDE-SHOW IMAGES</b></h3>
@stop
{{--breadcrumb--}}
@section('breadcrumbs')
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/admin/home')}}">Home /</a>
        <span class="breadcrumb-item active">Add Slide-show Images</span>
    </nav>
@stop
@section('content')

    <script language="javascript" type="text/javascript">
        function validation(){


            var image=document.reg.slide_pic.value;
            var extention2 = image.substring(image.lastIndexOf('.') + 1).toLowerCase();
            if(extention2 != "gif" && extention2 != "png" && extention2 != "bmp" && extention2 != "jpg" && extention2 != "jpeg")
            {
                alert("template picture not in valid extention (use only gif,png,bmp,jpg,jpeg extentions...!."+extention2);
                return false;
            }
            else
            {
                var image_size=document.reg.slide_pic.files[0].size;
                if(image_size>1024*1024*0.5)
                {
                    alert("template picture size is too large!");
                    return false;
                }
            }


            return confirm("Are you sure to INSERT this record?");
        }
    </script>


    <div class="row">
        <div class="tab-pane" id="settings">



            <form data-parsley-validate="" class="form-horizontal" name="reg" action="{{ url('templates/slide/new')  }}" method="post" enctype="multipart/form-data" onsubmit="return validation()">




                {{ csrf_field() }}


                <div class="form-group">
                    <label for="Name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="name" required data-parsley-type="alphanum" data-parsley-maxlength="10" data-parsley-maxlength-message="Name should be less than 10 characters" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="Description" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="description" name="description" placeholder="description" required data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="40" data-parsley-minlength-message="description should be atleast 20 characters"  data-parsley-maxlength-message="description should be less than 40 characters">
                    </div>
                </div>
                <div class="form-group">
                    <label for="slide picture" class="col-sm-2 control-label">Slide picture</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="slide_pic" name="slide_pic" placeholder="slide_pic" required accept="image/*">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button title="Click here for add image" type="submit" class="btn btn-danger"><i class="fa fa-check-square-o" aria-hidden="true"></i><span> </span>Submit</button>
                    </div>
                </div>
            </form>
        </div><!-- /.tab-pane -->

        <h3 style="text-align: center"><b>SELECT SLIDE-SHOW IMAGES</b></h3>
        {{ csrf_field() }}
        <div class="col-xs-12">


            <div class="box">
                <div class="box-header">
                    <h4 class="box-title"><b>CURRENT SLIDE-SHOW</b></h4>
                    <br>
                    <!-- /.box-header -->
                </div>
                <div class="box-body">
                    <form data-parsley-validate="" class="form-horizontal" name="remove" action="{{ url('templates/slide/delete')  }}" method="post" enctype="multipart/form-data" novalidate>
                        @if($slide_album_count<8)
                            <button style="float: left;" title="click here to add image to slide show" type="button" class="btn btn-warning" data-toggle="modal" data-target="#replyModal">Add to Slide Show</button>
                        @endif

                        <button style="float: right;" title="click here to remove selected image from slide show" type="submit" name="submit1" class="btn btn-danger" onclick="return confirm('Are sure to remove selected imsges from the slide show?')" ><i class="fa fa-check-square-o" aria-hidden="true"></i><i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i></button>

                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row"><div class="col-sm-12">
                                    <input hidden="hidden" required="required" data-parsley-required-message="There are no selected images to remove" title="select image for slide show" style="zoom:2" type="checkbox" name="image_album[]" value="" >
                                    {{ csrf_field() }}


                                    @foreach($slide_album as $image)
                                        @if($image->status == 1)
                                            <div class="col-md-3" style="border: outset #190bff" title="id:{{ $image->id }}&#13name:{{ $image->name }}&#13description : {{ $image->description }}" >
                                                @else
                                                    <div class="col-md-3" style="border: outset" title="id:{{ $image->id }}&#13name:{{ $image->name }}&#13description : {{ $image->description }}" >
                                                        @endif
                                                        <input title="select image for slide show" style="zoom:1.5" type="checkbox" name="image_album[]" value="{{$image->id}}"> <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                        <img src='{{asset("img/preview/" . $image->slide_pic )  }}' alt="MountainView" style="width:200px;height:100px;"  >
                                                        <a href={{url("templates/slide/". $image->id ."/change1") }}><button style="border-radius: 50%;" title="Set for first image" type="button" class="btn btn-default" value="1" name="first" onclick="return confirm('Are sure to set this image as front image of the slide show?')"><i class="fa fa-heart" aria-hidden="true"></i></button></a>

                                                    </div>
                                                    @endforeach

                                            </div>
                                </div>
                                <div class="row">
                                    {{--<div class="col-sm-5">--}}
                                        {{--<div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-sm-7">--}}
                                        {{--<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="example2_previous"><a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0">6</a></li><li class="paginate_button next" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0">Next</a></li></ul>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            {{--</form>--}}


                    <!-- Modal-->
            <div class="modal fade" id="replyModal" role="dialog">
                <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <form data-parsley-validate="" class="form-horizontal" name="select" action="{{ url('templates/slide/select')  }}" method="post" enctype="multipart/form-data" novalidate>


                        <div class="modal-content">
                            <div class="modal-header">
                                {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                                <h4 class="modal-title"><b>SLIDE-SHOW IMAGE ALBUM</b></h4>
                                <input hidden="hidden" required="required" data-parsley-required-message="There are no selected images" data-parsley-maxcheck="{{8-$slide_album_count}}" title="select image for slide show" style="zoom:2" type="checkbox" name="image_album[]" value="" >


                            </div>
                            <div class="modal-body" style="overflow-y: scroll">

                                {{--<form class="form-horizontal" action="{{ url("templates/". $mail->id ."/reply")  }}" method="post" enctype="multipart/form-data">--}}
                                {{ csrf_field() }}

                                @foreach($slideimages as $slideimage)
                                    <div class="col-md-3"  >

                                        <a href="{{ url("templates/show/" .$slideimage->id) }}" target="_blank"><img src='{{asset("/img/preview/" . $slideimage->slide_pic )  }}' alt="MountainView" style="width:200px;height:100px;" title="id:{{ $slideimage->id }}&#13name:{{ $slideimage->name }}&#13description : {{ $slideimage->description }}" ></a>
                                        <input  title="select image for slide show" style="zoom:2" type="checkbox" name="image_album[]" value="{{$slideimage->id}}">
                                    </div>
                                @endforeach
                                {{--<div>--}}
                                  {{--{{$slideimages->render()}}--}}
                                {{--</div>--}}

                            </div>
                            <div class="modal-footer">
                                <button onclick="return confirm('Are sure to add selected images to the slide show?')" type="submit" name="submit" id="submit" class="btn btn-danger"><i class="fa fa-check-square-o" aria-hidden="true"></i><span> </span>Add to Slide Show</button>
                            </div>
                        </div>
                    </form>
                </div></div>


        </div><!-- /.tab-content -->
    </div><!-- /.nav-tabs-custom -->
    </div><!-- /.col -->
    </div><!-- /.row -->
    </div>
@section('notifications')
    @include('includes.notification')
@stop

@endsection
