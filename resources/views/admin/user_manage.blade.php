@extends('app')


@section('pageName')
    <h3 style="text-align: center"><b>USER DETAIIT</b></h3>
@stop
{{--breadcrumb--}}
@section('breadcrumbs')
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/admin/home')}}">Home /</a>
        <span class="breadcrumb-item active">User Details</span>
    </nav>
@stop
@section('content')
    <script language="javascript" type="text/javascript">
        function validation() {

            var a = document.reg.reason.value;

            if ((a == null || a == "")) {
                alert("Enter DEMOTION REASON...!.");
                return false;
            }

            return confirm("Are you sure to demote this user");
        }
        function validation1(){

            var a=document.reg1.kick_message.value;

            if ((a == null||a == "") ) {
                alert("Enter REMOVING REASON...!.");
                return false;
            }

            return confirm("Are you sure to remove this user?");
        }
    </script>
    <a href={{url("/admin/user/removed") }}><button title="click here tp view removed users" type="button" style="float: right;" class="btn btn-danger"><i class="fa fa-list-ul" aria-hidden="true"></i><span> </span><i class="fa fa-user-times" aria-hidden="true"></i></button></a><div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="User ID: activate to sort column descending">User ID</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">Name</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Email</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Mobile: activate to sort column ascending">Mobile</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Access Level: activate to sort column ascending">Access Level</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Image: activate to sort column ascending">Image</th> </tr>
                                </thead>
                                <tbody>

                                @foreach($users as $user)
                                    <tr role="row" class="">

                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->mobile }}</td>
                                        @if($user->type=='client')<td>USER</td>@endif
                                        @if($user->type=='moderator')<td>MODERATOR</td>@endif
                                        @if($user->type=='admin')<td>ADMIN</td>@endif
                                        <td></td>
                                        @if($loged_user->type=='moderator')
                                            @if($user->type=='client')
                                                <td></td>
                                                <td style="text-align: center"><a href={{url("user/". $user->id ."/promote") }}><button title="Promote to Moderator" type="button" class="btn btn-success" onclick="return confirm('Are you sure to PROMOTE this user to MODERATOR?');"><i class="fa fa-user" aria-hidden="true"></i><span> </span><i class="fa fa-arrow-up" aria-hidden="true"></i></button></a></td>
                                                <td></td>
                                                <td style="text-align: center"><button title="click here to remove user" type="button" class="btn btn-danger" data-toggle="modal" data-target="#kickModal{{$user->id}}"><i class="fa fa-user-times" aria-hidden="true"></i></button></td>
                                            @endif
                                        @endif
                                        @if($loged_user->type=='admin')
                                            @if($user->type=='client')
                                                <td></td>
                                                <td style="text-align: center"><a href={{url("user/". $user->id ."/promote") }}><button title="Promote to Moderator" type="button" class="btn btn-success" onclick="return confirm('Are you sure to PROMOTE this user to MODERATOR?');"><i class="fa fa-user" aria-hidden="true"></i><span> </span><i class="fa fa-arrow-up" aria-hidden="true"></i></button></a></td>
                                                <td></td>
                                                <td style="text-align: center"><button title="click here to remove user" type="button" class="btn btn-danger" data-toggle="modal" data-target="#kickModal{{$user->id}}"><i class="fa fa-user-times" aria-hidden="true"></i></button></td>
                                            @else
                                                <td style="text-align: center"><a href={{url("user/". $user->id ."/pro_super_admin") }}><button title="Promote to Admin" type="button" class="btn btn-info" onclick="return confirm('Are you sure to PROMOTE this user to ADMIN?');"><i class="fa fa-user" aria-hidden="true"></i><span> </span><i class="fa fa-arrow-circle-up" aria-hidden="true"></i></button></a></td>
                                                <td></td>
                                                <td style="text-align: center"><button title="click here to do demotions" type="button" class="btn btn-warning" data-toggle="modal" data-target="#demoteModal{{$user->id}}"><i class="fa fa-user" aria-hidden="true"></i><span> </span><i class="fa fa-arrow-down" aria-hidden="true"></i></button></td>
                                                <td style="text-align: center"><button title="click here to remove user" type="button" class="btn btn-danger" data-toggle="modal" data-target="#kickModal{{$user->id}}"><i class="fa fa-user-times" aria-hidden="true"></i></button></td>
                                            @endif
                                        @endif
                                    </tr>
                                    <div class="modal fade" id="demoteModal{{$user->id}}" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Demotion Modal</h4>
                                                </div>
                                                <div class="modal-body">
                                                    @if($user->type=='moderator')
                                                        <form class="form-horizontal" name="reg" action="{{ url("user/". $user->id ."/demote")  }}" method="post" enctype="multipart/form-data" onsubmit="return validation()">
                                                            {{ csrf_field() }}
                                                            <input type="radio" name="reason" value="Disciplinary actions">Disciplinary actions<br>
                                                            <input type="radio" name="reason" value="Low performer">Low performer<br>
                                                            <input type="radio" name="reason" value="Dishonest">Dishonest<br>
                                                            <input type="radio" name="reason" value="Misappropriation">Misappropriation<br>
                                                            <input type="radio" name="reason" value="Create conflict at work place">Create conflict at work place<br>
                                                            <input type="radio" name="reason" value="Mistakenly promoted you">Mistakenly promote you<br>
                                                            <input type="submit" class="btn btn-warning" value="Send" >
                                                        </form>
                                                    @endif
                                                    @if($user->type=='client')
                                                        <h3>You are already a USER</h3>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal fade" id="kickModal{{$user->id}}" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Kick-out Modal</h4>
                                                </div>
                                                <div class="modal-body">

                                                    <form class="form-horizontal" name="reg1" action="{{ url("user/". $user->id ."/kick-out")  }}" method="post" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <textarea name="kick_message" id="kick_message" class="form-control" rows="4" cols="60" placeholder="Enter your message" required="required"></textarea>
                                                        <input type="submit" class="btn btn-warning" value="Send" onclick="return confirm('Are you sure to REMOVE this user?');" >
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                            </table></div></div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite"></div>
                        </div>
                        <div class="col-sm-7">
                            <div>
                                {{$users->render()}}
                            </div>
                        </div></div></div>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
@section('notifications')
    @include('includes.notification')
@stop

@endsection