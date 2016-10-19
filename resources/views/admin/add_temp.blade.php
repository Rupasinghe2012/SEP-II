@extends('app')



@section('content')

    <div class="tab-pane" id="settings">

        <script language="javascript" type="text/javascript">
            function validation(){
                var source=document.reg.temp_source.value;
                var extention1 = source.substring(source.lastIndexOf('.') + 1).toLowerCase();
                if(extention1 != "php" && extention1 != "html")
                {
                    alert("template source not in valid extention (use only php,html extentions...!."+extention1);
                    return false;
                }

                var image_size=document.reg.temp_pic.files[0].size;
                var image=document.reg.temp_pic.value;
                var extention2 = image.substring(image.lastIndexOf('.') + 1).toLowerCase();
                if(extention2 != "gif" && extention2 != "png" && extention2 != "bmp" && extention2 != "jpg" && extention2 != "jpeg")
                {
                    alert("template picture not in valid extention (use only gif,png,bmp,jpg,jpeg extentions...!."+extention2);
                    return false;
                }
                else
                {
                    if(image_size>1024*1024*0.5)
                    {
                        alert("template picture size is too large!");
                        return false;
                    }
                }


                        return confirm("Are you sure to INSERT this record?");
            }
        </script>
        <h3 style="text-align: center">Add template</h3>

        <form data-parsley-validate="" class="form-horizontal" name="reg" action="{{ url('templates/store')  }}" method="post" enctype="multipart/form-data" onsubmit="return validation()">


            {{ csrf_field() }}

            <div class="form-group">
                <label for="Name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input required data-parsley-type="alphanum" data-parsley-maxlength="10" data-parsley-maxlength-message="Name should be less than 10 characters" type="text" class="form-control" id="name" name="name" placeholder="name">
                </div>
            </div>
            <div class="form-group">
                <label for="Colour" class="col-sm-2 control-label">Colour</label>
                <div class="col-sm-10">
                    <input required type="color" class="form-control" id="colour" name="colour" placeholder="colour">
                </div>
            </div>
            <div class="form-group">
                <label for="Description" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <input required data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="75" data-parsley-minlength-message="description should be atleast 20 characters"  data-parsley-maxlength-message="description should be less than 75 characters" type="textarea" class="form-control" id="description" name="description" placeholder="description">
                </div>
            </div>
            <div class="form-group">
<<<<<<< HEAD
                <label for="Price" class="col-sm-2 control-label">Price (Rs:)</label>
=======
                <label for="Price" class="col-sm-2 control-label">Price Rs:</label>
>>>>>>> origin/master
                <div class="col-sm-10">
                    <input required data-parsley-maxlength="10" data-parsley-type="digits" type="text" class="form-control" id="price" name="price" placeholder="price">
                </div>
            </div>
            <div class="form-group">
                <label for="template source" class="col-sm-2 control-label">template source</label>
                <div class="col-sm-10">
                    <input required type="file" class="form-control" id="temp_source" name="temp_source" placeholder="temp_source" multiple="multiple">
                </div>
            </div>
            <div class="form-group">
                <label for="template picture" class="col-sm-2 control-label">template picture</label>
                <div class="col-sm-10">
                    <input required type="file" class="form-control" id="temp_pic" name="temp_pic" placeholder="temp_pic" accept="image/*">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="submit" id="submit" class="btn btn-danger"><i class="fa fa-check-square-o" aria-hidden="true"></i><span> </span>Submit</button>
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
