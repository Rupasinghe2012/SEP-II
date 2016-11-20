@extends('app')


@section('pageName')
    <h3 style="text-align: center"><b>EDIT TEMPLATE</b></h3>
@stop
{{--breadcrumb--}}
@section('breadcrumbs')
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/admin/home')}}">Home /</a>
        <a class="breadcrumb-item" href="{{url('/templates/edit')}}">Temp Details /</a>
        <span class="breadcrumb-item active">Edit Temp</span>
    </nav>
@stop
@section('content')

    <script language="javascript" type="text/javascript">
        function validation(){

            var source=document.reg.temp_source.value;
            if(source!="") {
                var extention1 = source.substring(source.lastIndexOf('.') + 1).toLowerCase();
                if (extention1 != "php" && extention1 != "html") {
                    alert("template source not in valid extention (use only php,html extentions...!).");
                    return false;
                }
            }
//
            var image=document.reg.temp_pic.value;
            if(image!="") {
                var extention2 = image.substring(image.lastIndexOf('.') + 1).toLowerCase();
                if (extention2 != "gif" && extention2 != "png" && extention2 != "bmp" && extention2 != "jpg" && extention2 != "jpeg") {
                    alert("template picture not in valid extention (use only gif,png,bmp,jpg,jpeg extentions...!).");
                    return false;
                }
                else {
                    var image_size=document.reg.temp_pic.files[0].size;
                    if (image_size > 1024 * 1024 * 0.5) {
                        alert("template picture size is too large!");
                        return false;
                    }
                }

            }
            return confirm("Are you sure to UPDATE this record?");
        }
    </script>

    <div class="tab-pane" id="settings">



        <form data-parsley-validate="" class="form-horizontal" name="reg" action="{{url("templates/". $temp->id ."/update") }}" method="post" enctype="multipart/form-data" onsubmit="return validation()">


            {{ csrf_field() }}

            <div class="form-group">
                <label for="Name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input readonly required data-parsley-type="alphanum" data-parsley-maxlength="10" data-parsley-maxlength-message="Name should be less than 10 characters" type="text" class="form-control" id="name" name="name" placeholder="name" value="{{ $temp->name }}">
                </div>
            </div>
            <div class="form-group">
                <label for="Colour" class="col-sm-2 control-label">Colour</label>
                <div class="col-sm-10">
                    <input required  type="color" class="form-control" id="colour" name="colour" placeholder="colour" value="{{ $temp->colour }}">
                </div>
            </div>
            <div class="form-group">
                <label for="Description" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <input required data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="75" data-parsley-minlength-message="description should be atleast 20 characters"  data-parsley-maxlength-message="description should be less than 75 characters" type="textarea" class="form-control" id="description" name="description" placeholder="description" value="{{ $temp->description }}">
                </div>
            </div>
            <div class="form-group">
                <label for="Price" class="col-sm-2 control-label">Price Rs:</label>
                <div class="col-sm-10">
                    <input required data-parsley-maxlength="10" data-parsley-type="digits" type="text" class="form-control" id="price" name="price" placeholder="price" value="{{ $temp->price }}">
                </div>
            </div>
            <div class="form-group">
                <label for="temp_source" class="col-sm-2 control-label">template source</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="temp_source_current" name="temp_source_current" placeholder="temp_source_current" value="{{ $temp->temp_source }}" readonly>
                    <input type="file" class="form-control" id="temp_source" name="temp_source" placeholder="temp_source">
                </div>
            </div>
            <div class="form-group">
                <label for="inputSkills" class="col-sm-2 control-label">template picture</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="temp_pic_current" name="temp_pic_current" placeholder="temp_pic_current" value="{{ $temp->temp_pic }}" readonly>
                    <input type="file" class="form-control" id="temp_pic" name="temp_pic" placeholder="temp_pic" accept="image/*">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button title="Click here to edit" type="submit" class="btn btn-danger"><i class="fa fa-check-square-o" aria-hidden="true"></i><span> </span>Submit</button>
                </div>
            </div>
        </form>
    </div><!-- /.tab-pane -->
    </div><!-- /.tab-content -->
    </div><!-- /.nav-tabs-custom -->
    </div><!-- /.col -->
    </div><!-- /.row -->
@section('notifications')
    @include('includes.notification')
@stop

@endsection