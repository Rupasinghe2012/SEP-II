@extends('app')
@section('content')

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Add Post</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" action="{{route('post.update',$users->id)}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
            <div class="box-body">
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">SiteName</label>
                    <div class="col-sm-10">
                        <input type="text" required class="form-control" id="siteid" placeholder="SiteID" name="siteid" value={{$users->sitename}} disabled>
                        <input type="hidden" name="id" value={{$users->sitename}}>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Post</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" placeholder="Enter ..." name="description" style="resize:none;" required >{{$users->description}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">ImageName</label>
                    <div class="col-sm-10">
                        <input type="text" required class="form-control" id="imgname" placeholder="Name.." name="name">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="file" required name="image" id="image">
                    </div>
                </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <input type="submit" class="btn btn-info pull-right" style="margin-right:10px;">
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
                                {{$value->description}}
                            </td>
                            <td>
                                <img src="{{url('resources/assets/img/postpreviewimage/'.$value->image)}}">
                            </td>
                            <td>
                                {{$value->created_at}}
                            </td>
                            <td>
                              <form method="post" action="{{route('post.destroy',$value->id)}}">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" class="btn btn-success" value="Delete" >
                              </form>
                            </td>
                        <tr>
                    @endforeach

                    </tbody></table>
            </div><!-- /.box-body -->

        </div><!-- /.box -->

@endsection
