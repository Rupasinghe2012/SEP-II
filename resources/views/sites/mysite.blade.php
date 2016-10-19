@extends('app')
@section('content')



  @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
      {{Session::get('success')}}
    </div>
  @endif

  <div class="col-md-12">
      <div class="box">
          <div class="box-header with-border">
              <h3 class="box-title">Created Sites</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
              <table class="table table-bordered">
                  <tbody><tr>
                      <th>SiteName</th>
                      <th>HostName</th>
                      <th>TemplateName</th>
                      <th>Created At</th>
                  </tr>
                  @foreach($sites as $key=>$value)
                      <tr>
                          <td>{{$value->sitename}}</td>
                          <td>{{$value->hostname}}</td>
                          <td>{{$value->templatename}}</td>
                          <td>{{date('M-n-Y : g:i a',strtotime($value->created_at))}}</td>
                          <td>
                            <form method="get" action="{{route('site.show',$value->sitename)}}">
                              <input type="submit" value="view" class="btn btn-sm btn-primary">
                            </form>
                          </td>
                          <td>
                            <form class="sitedelete" method="post" action="{{route('site.destroy',$value->siteid)}}">
                              {{csrf_field()}}
                              <input type="hidden" name="_method" value="DELETE">
                              <input type="submit" value="delete" class="btn btn-sm btn-danger" id="sitedelete">
                            </form>
                          </td>

                          <td><a class="demo01" href="#animatedModal">Change Template</a></td>

                          <td>
                            <!-- <a id="tempchange" val="{{$value->templatename}}">Change Template</a> -->
                            <a href="{{route('viewtempchange.temp',[$value->templatename,$value->siteid])}}">Change Template</a>
                          </td>

                      </tr>
                  @endforeach
                  </tbody>
              </table>
          </div><!-- /.box-body -->

      </div>

  </div>
  <div class="text-center">
  {!!$sites->links()!!}
</div>


@endsection
