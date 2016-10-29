@extends('app')

@section('content')

<div class="container">

    <div class="row">

        <div class="box box-info">

            <div class="box-header with-border">
                <h3 class="box-title"><b>Update Post</b></h3>
            </div>

            <div class="box-body">
                <div class="form-group" style="margin-bottom:60px;">
                    <label for="inputPassword3" class="col-sm-2 control-label">SiteName</label>
                    <div class="col-sm-10" >
                        <input type="text" style="width:100px;" class="form-control" id="siteid" placeholder="SiteID" name="siteid" value={{$users->sitename}} disabled>
                        <input type="hidden" name="id" value={{$users->sitename}}>
                    </div>
                </div>

                <div class="form-group" id="summernote">{!!$users->description!!}</div>

            </div>

            <div class="box-footer">
                <input type="button" value="update" class="btn btn-info pull-right" style="margin-right:10px;" id="update">
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
                        <th>Description</th>
                        <th>Image</th>
                        <th>Created Date</th>
                    </tr>

                    @foreach($test as $key=>$value)
                        <tr>
                            <td>
                                {{$value->sitename}}
                            </td>
                            <td>
                                {!!$value->description!!}
                            </td>
                            <td>
                                {{$value->created_at}}
                            </td>
                            <td>
                              <form class="delpost" method="post" action="{{route('post.destroy',$value->id)}}">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" class="btn btn-success" value="Delete" id="postdel">
                              </form>
                            </td>
                        <tr>
                    @endforeach

                    </tbody>
                </table>

            </div>

        </div>

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
              $("#update").click(function(){

                  var data=$("#summernote").summernote('code');
                  var url='{!!url('updatepost/'.$users->id)!!}';
                  var site=$("#siteid").val();

                  if(data=='<p><br></p>')
                  {
                      swal({
                          title:"<h1>Warning</h1>",
                          text: '<h3 style="color:red;">Post cannot be empty</h3>',
                          html: true
                      });
                  }
                  else if(data!='<p><br></p>')
                  {
                      $.ajax({
                          type:'GET',
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
          });
        </script>
@endsection
