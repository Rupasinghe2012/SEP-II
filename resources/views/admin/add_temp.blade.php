@extends('app')



@section('content')

    <div class="tab-pane" id="settings">

        <script language="javascript" type="text/javascript">
            function validation(){

                var a=document.reg.name.value;
                var b=document.reg.colour.value;
                var c=document.reg.description.value;
                var d=document.reg.price.value;
                var f=document.reg.temp_source.value;
                var g=document.reg.temp_pic.value;

                if ((a == null||a == "") ) {
                    alert("Enter TEMPLATE NAME...!.");
                    return false;
                }
                if(a.match(/[^A-Za-z]/))
                {
                    alert("Enter alphbatical characters for TEMPLATE NAME! (Allowed input:A-Z/a-z)");
                    return false;
                }
                if (b==null||b=="") {
                    alert("Enter COLOUR of template...!");
                    return false;
                }
                if(b.match(/[^A-Za-z]/))
                {
                    alert("Enter alphbatical characters for COLOUR! (Allowed input:A-Z/a-z)");
                    return false;
                }
                if (c == null||c == "" ) {
                    alert("Enter DESCRIPTION of template...!.");
                    return false;
                }
                if(c.match(/[^A-Za-z]/))
                {
                    alert("Enter alphbatical characters for DESCRIPTION! (Allowed input:A-Z/a-z)");
                    return false;
                }
                if (d == null||d == "") {
                    alert("Enter PRICE of template...!.");
                    return false;
                }
                if(!d.match(/^\d+/))
                {
                    alert("Enter Numeric characters for PRICE! (Allowed input:0-9)");
                    return false;
                }
                if (f==null||f=="") {
                    alert("Insert TEMPLATE SOURCE FILE...!");
                    return false;
                }
                if (g==null||g=="") {
                    alert("Enter TEMPLATE PICTURE ...!");
                    return false;
                }
                return confirm("Are you sure to INSERT this record?");
            }
        </script>
        <h3 style="text-align: center">Add template</h3>

        <form class="form-horizontal" name="reg" action="{{ url('templates/store')  }}" method="post" enctype="multipart/form-data" onsubmit="return validation()">


            {{ csrf_field() }}

            <div class="form-group">
                <label for="Name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="name">
                </div>
            </div>
            <div class="form-group">
                <label for="Colour" class="col-sm-2 control-label">Colour</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="colour" name="colour" placeholder="colour">
                </div>
            </div>
            <div class="form-group">
                <label for="Description" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <input type="textarea" class="form-control" id="description" name="description" placeholder="description">
                </div>
            </div>
            <div class="form-group">
                <label for="Price" class="col-sm-2 control-label">Price</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="price" name="price" placeholder="price">
                </div>
            </div>
            {{--<div class="form-group">--}}
            {{--<label for="URL" class="col-sm-2 control-label">URL</label>--}}
            {{--<div class="col-sm-10">--}}
            {{--<input type="textarea" class="form-control" id="url" name="url" placeholder="url">--}}
            {{--</div>--}}
            {{--</div>--}}
            <div class="form-group">
                <label for="template source" class="col-sm-2 control-label">template source</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="temp_source" name="temp_source" placeholder="temp_source" multiple="multiple">
                </div>
            </div>
            <div class="form-group">
                <label for="template picture" class="col-sm-2 control-label">template picture</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="temp_pic" name="temp_pic" placeholder="temp_pic">
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

@endsection