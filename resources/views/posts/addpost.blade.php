@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Post</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="{{route('post.store')}}" enctype="multipart/form-data" id="addpost">
                    {{csrf_field()}}
                    <div class="box-body">
                        <!-- <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">SiteID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="siteid" placeholder="SiteID" name="siteid">
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label for="siteid" class="col-sm-2 control-label">SiteName</label>
                            <select name="sitename" style="margin-left:19px;margin-bottom:30px;" required>
                                @foreach($site as $value)
                                    <option value="{{$value->sitename}}">{{$value->sitename}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Post</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="3" placeholder="Enter ..." name="description"  style="resize:none;" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">ImageName</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="imgname" placeholder="Name.." name="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="fileinput fileinpu-new" data-provides="fileinput">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="file" required name="image" id="image">
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right" >Add</button>
                    </div><!-- /.box-footer -->
                </form>
            </div>

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">All Posts</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody><tr>
                                <th style="width: 10px">SiteName</th>
                                <th>Post ID</th>
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
                                      {{$value->id}}
                                    </td>
                                    <td>
                                        {{$value->description}}
                                    </td>
                                    <td>
                                        <img src="{{url('resources/assets/img/postpreviewimage/'.$value->image)}}">
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
                                          <input type="submit" class="btn btn-success" value="Update">
                                        </form>
                                    </td>
                                <tr>
                            @endforeach

                            </tbody></table>
                    </div><!-- /.box-body -->

                </div><!-- /.box -->
            </div>
            <div style="text-align:center;">
              {!!$test->links()!!}
            </div>
        </div>

</div>
@endsection
