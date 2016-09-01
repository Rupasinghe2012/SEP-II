@extends('app')



@section('content')



    <script language="javascript" type="text/javascript">
        function validation1(){

            var currentPass=document.pwd.currentp.value;
            var newPass=document.pwd.newp.value;
            var confirmPass=document.pwd.rep.value;



            if ((currentPass == null||currentPass == "") ) {
                swal("Error !!!!", "Enter a your name Please.")
                return false;
            }

            else if (newPass == null||newPass == "" ) {
                swal("Error !!!!", "Please select your status.")
                return false;
            }

            else if (confirmPass == null||confirmPass == "" ) {
                swal("Error !!!!", "Please select your status.")
                return false;
            }

            else if(newPass!= confirmPass)
            {
                swal("Error !!!!", "New Password Does not Match .")
                return false;
            }

            else {
                return swal("Succesfull!!!!", "Your password has been Changed", "success")


            }

        }
    </script>

    <script language="javascript" type="text/javascript">
        function validation2(){

            var fb=document.links.fb.value;
            var youtube=document.links.youtube.value;
            var google=document.links.google.value;
            var instagram=document.links.instagram.value;
            var twiter=document.links.twiter.value;



            if ((fb == null||fb == "") ) {
                swal("Error !!!!", "Enter a your name Please.")
                return false;
            }

            else if(!fb.match(/^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/))
            {
                swal("Error !!!!", "Enter a valid URL.")
                return false;
            }
            else if(!youtube.match(/^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/))
            {
                swal("Error !!!!", "Enter a valid URL.")
                return false;
            }
            else if(!google.match(/^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/))
            {
                swal("Error !!!!", "Enter a valid URL.")
                return false;
            }
            else if(!instagram.match(/^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/))
            {
                swal("Error !!!!", "Enter a valid URL.")
                return false;
            }
            else if(!twiter.match(/^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/))
            {
                swal("Error !!!!", "Enter a valid URL.")
                return false;
            }
            else {
                return swal("Succesfull!!!!", "Your Saved Profile Links", "success")


            }

        }
    </script>




    <script language="javascript" type="text/javascript">
        function validation(){

            var name=document.pro.name.value;
            var email=document.pro.email.value;
            var status=document.pro.status.value;
            var bod=document.pro.BOD.value;
            var adress=document.pro.address.value;
            var job=document.pro.job.value;




            if ((name == null) ) {
                swal("Error !!!!", "Enter a your name Please.")
                return false;
            }
            else if(name.match(/[^A-Za-z]/))
            {
                swal("Error !!!!", "Enter a valid name.")
                return false;
            }

            else if (status == null||status == "" ) {
                swal("Error !!!!", "Please select your status.")
                return false;
            }

            else if (bod == null||bod == "") {
                swal("Error !!!!", "Enter a your Data of Birth.")
                return false;
            }
            else if(!bod.match(/^\d+/))
            {
                swal("Error !!!!", "Enter a valid Date of Birth.")
                return false;
            }

            else if (adress==null) {
                swal("Error !!!!", "Enter a your Address Please.")
                return false;
            }
            else if (job==null) {
                swal("Error !!!!", "Please fill your Employment field.")
                return false;
            }
            else if(job.match(/[^A-Za-z]/))
            {
                swal("Error !!!!", "Enter a valid job.")
                return false;
            }
            else {
                return swal("Succesfull!!!!", "Your details have been updated", "success")


            }

        }
    </script>

    <div class="row">

        <div class="col-md-3">

            <!-- Modal for fb-->
            <div class=" modal-default">
                <div id="fb" class="modal fade" role="dialog">

                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Paste your profile link here.</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" role="form" method="post" action="{{ url('/userLINK') }}" name="links" onsubmit="return validation2()">

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="id" value="{{Auth::user()->id}}" />

                                    <div class="form-group">
                                        <a class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="submission_fb" name="fb" placeholder="Paste the Facebook Profile Link" value="{{Auth::user()->fb}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <a class="btn btn-social-icon btn-youtube"><i class="fa fa-youtube"></i></a>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="submission_youtube" name="youtube" placeholder="Paste the YouTube Chanel Link" value="{{Auth::user()->youtube}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <a class="btn btn-social-icon btn-google"><i class="fa fa-google"></i></a>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="submission_google" name="google" placeholder="Paste the Google+ Link'" value="{{Auth::user()->google}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <a class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="submission_twiter"  name="twiter" placeholder="Paste the Twitter Profile Link" value="{{Auth::user()->twiter}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <a class="btn btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="submission_instagram"  name="instagram" placeholder="Paste the Istagram Profile Link" value="{{Auth::user()->instagram}}">
                                        </div>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

                                <button type="submit" class="btn btn-danger" id="pro1">Save Links</button>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>



            <!-- Modal for password-->
            <div class=" modal-default">
                <div id="pwd" class="modal fade" role="dialog">

                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Change Password.</h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ url('/userpw') }}" name="pwd"  onsubmit="return validation1()" >
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="id" value="{{Auth::user()->id}}" />

                                    @if(Session::has('pwmessage'))
                                        <div class="alert alert-success">
                                            {{ Session::get('pwmessage') }}
                                        </div>
                                    @endif

                                    @if(Session::has('wmessage'))
                                        <div class="alert alert-danger">
                                            {{ Session::get('wmessage') }}
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label class="control-label">Current Password</label>
                                        <input type="password" id="currentp" class="form-control" name="currentp" placeholder="Type Current Password"/> </div>
                                    <div class="form-group">
                                        <label class="control-label">New Password</label>
                                        <input type="password" id="newp" class="form-control" name="newp" placeholder="Type New Password"/> </div>


                                    <div class="form-group">
                                        <label class="control-label">Re-type New Password</label>
                                        <input type="password" id="rep" class="form-control" name="rep" placeholder="ReType New Password"/> </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

                                <button type="submit" class="btn green" id="btnChange" >Change Password
                                </button>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>



            <!-- Modal for Tweter-->
            <div class=" modal-default">
                <div id="twiter" class="modal fade" role="dialog">

                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Twiter Widget.</h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ url('/twitter') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="id" value="{{Auth::user()->id}}" />

                                    <div class="form-group">
                                        <a class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="code"  name="code" placeholder="Paste your widget code" value=""></textarea>
                                        </div>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

                                <button type="submit" class="btn btn-primary" id="btnChange">Save
                                </button>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>






            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">

                    <img class="profile-user-img img-responsive img-circle" src="{{ Auth::user()->profile_pic==NULL ? URL::asset('/img/pro.jpg') : URL::asset(Auth::user()->profile_pic) }}" alt="User profile picture">
                    <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                    <p class="text-muted text-center">{{ Auth::user()->job }}</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <!-- <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-twitter"></i> <b>Twitter</b></a> -->
                            <div class="text-center">
                                <a href="{{Auth::user()->google}}" target="_blank"class="btn btn-social-icon btn-google"><i class="fa fa-google-plus"></i></a>
                                <a href="{{Auth::user()->youtube}}" target="_blank" class="btn btn-social-icon btn-youtube"><i class="fa fa-youtube"></i></a>
                                <a href="{{Auth::user()->fb}}" target="_blank"class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
                                <a href="{{Auth::user()->twiter}}" target="_blank" class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
                                <a href="{{Auth::user()->instagram}}"target="_blank" class="btn btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a>

                            </div>
                    </ul>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">About Me</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa-briefcase margin-r-5"></i>  Education</strong>
                    <p class="text-muted">
                        {{Auth::user()->job}}
                    </p>

                    <hr>

                    <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                    <p class="text-muted">{{Auth::user()->address}}</p>

                    <hr>



                    <hr>

                    <div class="box">

                        @foreach($wd as $wds)
                            @if($wds->user_id== Auth::user()->id)
                                <div class="box-body">
                                    {!!html_entity_decode($wds->code)!!}
                                </div>
                            @endif
                        @endforeach
                        <div class="box-header">
                            <h3 class="box-title">Add Your Twiter Widget Here</h3>
                        </div>
                        <div class="box-body">
                            <a class="btn btn-block btn-default" data-toggle="modal" data-target="#twiter">
                                <i class="fa fa-twitter"></i> Enter your Profile Links
                            </a>
                        </div>






                    </div>



                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#settings" data-toggle="tab">Edit Profile</a></li>
                    {{--<li ><a href="#changePwd" data-toggle="tab">Change Password</a></li>--}}



                </ul>
                <div class="tab-content">

                    <div class="tab-pane fade in active" id="settings">
                        @if(count($errors)>0)
                            <div class="alert alert-error">
                                @foreach($errors->all() as $error)
                                    {{$error}}
                                @endforeach
                            </div>
                        @endif

                        @if(Session::has('succes'))
                                <div class="alert alert-success">
                                    {{ Session::get('succes') }}
                                </div>
                            @endif

                        <form class="form-horizontal" id="pro" name="pro" role="form" method="post" action="{{ url('/user') }}" onsubmit="return validation()">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="id" value="{{Auth::user()->id}}" />

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Full Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="submission_name"  name="name" placeholder="Name" value="{{Auth::user()->name}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-2 control-label">E-Mail</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="submission_email" name="email" placeholder="Enter your Email Address" value="{{Auth::user()->email}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Status</label>
                                {{--<div class="col-sm-10">--}}
                                {{--<input type="text" class="form-control" id="submission_status" name="status" placeholder="Maried Or Unmaried" value="{{Auth::user()->status}}">--}}
                                {{--</div>--}}
                                <div class="col-sm-10">
                                    <select id="status" class="form-control" name="status">
                                        @if(Auth::user()->status == 'Maried')
                                            <option value="Maried" selected >Maried</option>
                                            <option value="Unmaried" >Unmaried</option>
                                        @elseif(Auth::user()->status == 'unmaried')
                                            <option value="Unmaried" selected>Unmaried</option>
                                            <option value="Maried"  >Maried</option>
                                        @else
                                            <option value="Maried"  >Maried</option>
                                            <option value="Unmaried" >Unmaried</option>
                                        @endif
                                    </select>
                                </div>


                            </div>


                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Date Of Birth</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" id="submission_BOD" name="BOD" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="{{Auth::user()->BOD}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Address</label>
                                <div class="col-sm-10">
                                    <input type="textarea" class="form-control" id="submission_address" name="address" placeholder="Entter Your Address" value="{{Auth::user()->address}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Empolyment</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="submission_job" name="job" placeholder="Enter your Job" value="{{Auth::user()->job}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Mobile No</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <input type="text" id="submission_mobile" name="mobile" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask value="{{Auth::user()->mobile}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button  type="submit" class="btn btn-danger"  name="submit">Submit</button>
                                </div>
                            </div>
                        </form>


                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Change The Password</h3>
                            </div>
                            <div class="box-body">
                                <a class="btn btn-block btn-info" data-toggle="modal" data-target="#pwd">Change Password</a>

                            </div>
                        </div>
                        <!-- profile pic -->
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Change The Profile Pciture</h3>
                            </div>
                            <div class="box-body">


                                <form method="post" action="{{ url('/user/pic') }}" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="id" value="{{Auth::user()->id}}" />
                                    <div class="form-group">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 222px; height: 205px;">
                                                <img src="{{Auth::user()->profile_pic==NULL ? URL::asset('/img/pro.jpg') : URL::asset(Auth::user()->profile_pic) }}" alt="" /> </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 222px; max-height: 205px;"> </div>
                                            <div>
                                                                            <span class="btn default btn-file">
                                                                                <button class="btn btn-dark" for="profile_pic">Choose an Image</button>
                                                                                <input id="profile_pic" name="profile_pic" type="file" accept="image/*" >
                                                                            </span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="margin-top-10">

                                                <span>
                                                    <button type="submit" class="btn green" id="btnSubmitPro">Upload Profile Picture
                                                    </button>
                                                </span>


                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Paste Your Social Profile Link Here...</h3>
                            </div>
                            <div class="box-body">


                                <a class="btn btn-block btn-default" data-toggle="modal" data-target="#fb">
                                    <i class="fa fa-facebook"></i><i class="fa fa-google-plus"></i><i class="fa fa-instagram"></i><i class="fa fa-twitter"></i><i class="fa fa-youtube"></i> Enter your Profile Links
                                </a>
                            </div>
                        </div>




                    </div><!-- /.tab-pane -->

                {{--<div class=" tab-pane fade " id="changePwd">--}}
                    {{--<form method="post" action="{{ url('/userpw') }}" name="pwd" >--}}
                        {{--<input type="hidden" name="_token" value="{{ csrf_token() }}" />--}}
                        {{--<input type="hidden" name="id" value="{{Auth::user()->id}}" />--}}

                        {{--@if(Session::has('pwmessage'))--}}
                            {{--<div class="alert alert-success">--}}
                                {{--{{ Session::get('pwmessage') }}--}}
                            {{--</div>--}}
                        {{--@endif--}}

                        {{--@if(Session::has('wmessage'))--}}
                            {{--<div class="alert alert-danger">--}}
                                {{--{{ Session::get('wmessage') }}--}}
                            {{--</div>--}}
                        {{--@endif--}}

                        {{--<div class="form-group">--}}
                            {{--<label class="control-label">Current Password</label>--}}
                            {{--<input type="password" id="currentp" class="form-control" name="currentp" placeholder="Type Current Password"/> </div>--}}
                        {{--<div class="form-group">--}}
                            {{--<label class="control-label">New Password</label>--}}
                            {{--<input type="password" id="newp" class="form-control" name="newp" placeholder="Type New Password"/> </div>--}}


                        {{--<div class="form-group">--}}
                            {{--<label class="control-label">Re-type New Password</label>--}}
                            {{--<input type="password" id="rep" class="form-control" name="rep" placeholder="ReType New Password"/> </div>--}}


                    {{--<button type="submit" class="btn btn-success" id="btnChange" >Change Password--}}
                    {{--</button>--}}
                    {{--</form>--}}
                    {{--</div>--}}
                </div><!-- /.tab-content -->




            </div><!-- /.nav-tabs-custom -->
        </div><!-- /.col -->
    </div><!-- /.row -->




@section('notifications')
    @include('includes.notification')
@stop

{{--scripts--}}
@section('scripts')
        <!-- InputMask -->
    <!-- Select2 -->
    <script src="{{ asset('/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.js')}}"></script>
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>


    <script>
        $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();

            //Datemask dd/mm/yyyy
            $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
            //Datemask2 mm/dd/yyyy
            $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
            //Money Euro
            $("[data-mask]").inputmask();


        });
    </script>

    <script type="text/javascript">
        $("#btnSubmitPro").click(function(){
            var picVal = $("#profile_pic").val();
            if(picVal == "")
            {
                swal("Please choose an image to upload!")
                return false;
            }
        })
    </script>

    <script type="text/javascript">
        @if (count($errors) > 0)
            $('#pwd').modal('show');
        @endif
    </script>
@stop

@endsection