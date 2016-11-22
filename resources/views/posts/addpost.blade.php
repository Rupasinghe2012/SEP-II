@extends('app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="box box-info">

                <div class="box-header with-border">
                    <h3 class="box-title"><b>Add Post</p></h3>
                </div>

                    <div class="box-body">

                         <div class="form-group">
                            <label for="siteid" class="col-sm-2 control-label">SiteName</label>
                            <select name="sitename"  style="margin-left:19px;margin-bottom:30px;" id="op" required>
                                <option></option>
                                @foreach($site as $value)

                                    <option  value="{{$value->sitename}}">{{$value->sitename}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group" id="summernote"></div>

                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right" id="add">Add</button>
                    </div>

            </div>

            <div class="col-md-12">

                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">All Posts</h3>
                    </div>

                    <div class="box-body">

                        <table class="table table-bordered">
                            <tbody><tr>
                                <th style="width: 10px">SiteName</th>
                                <th>Post ID</th>
                                <th>Description</th>
                                <th>Created Date</th>
                            </tr>

                            @foreach($test as $key=>$value)
                                <tr>
                                    <td>
                                        {{$value->sitename}}
                                    </td>
                                    <td>
                                      {{$value->id}}
                                    </td>
                                    <td>
                                        {!!$value->description!!}
                                    </td>
                                    <td>
                                        {{$value->created_at}}
                                    </td>
                                    <td>
                                        <form class="delpost" method="post" action="{{route('post.destroy',$value->id)}}" >
                                          {{csrf_field()}}
                                          <input type="hidden" name="_method" value="DELETE">
                                            <input type="submit" class="btn btn-success" value="Delete" id="postdel">
                                        </form>
                                    </td>
                                    <td>
                                        <form method="get" action="{{route('post.show',$value->id)}}" >
                                          <input type="submit" class="btn btn-success" value="Update" >
                                        </form>
                                    </td>
                                <tr>
                            @endforeach

                            </tbody>
                        </table>

                    </div>

                </div>

            </div>

            <div style="text-align:center;">
              {!!$test->links()!!}
            </div>

        </div>

</div>

<script>

    $(document).ready(function(){

        //initilalizing summernote editor
        $('#summernote').summernote({
            height:200,
            width:1100
        });

        //retrieving data when user clicks on add button
        $("#add").click(function(){

            var data=$("#summernote").summernote('code');
            var url='{!!route('post.store')!!}';
            var site=$("#op option:selected").text();

            //validating site from the dropdownlist
            if(site=='')
            {

                swal({
                    title:"<h1>Warning</h1>",
                    text: '<h3 style="color:red;">Select site name</h3>',
                    html: true
                });
            }
            //validating post field
            if(data=='<p><br></p>')
            {

                swal({
                    title:"<h1>Warning</h1>",
                    text: '<h3 style="color:red;">Post cannot be empty</h3>',
                    html: true
                });
            }
            else if((data!='<p><br></p>') && (site!='')){
                $.ajax({
                    type:'POST',
                    url:url,
                    data:{d:data,s:site},
                    success:function(data){
                        if(data=="t")
                        {
                            window.location.href='{!!route('post.create')!!}'; //redirecting to post create view
                        }
                        else {
                            sweetAlert("Oops...", "Something went wrong!", "error");
                        }



                    }
                });
            }
        });

    })

</script>
@endsection
