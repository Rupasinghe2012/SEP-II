<!DOCTYPE html>
<html lang="en">
<head>

    <title>Bootstrap Case</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('/css/lightbox.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
    <script src="{{ asset('/dist/sweetalert.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('/dist/sweetalert.css') }}">
    <script src="{{ asset('/js/Gimages.js') }}"></script>
    <script src="{{ asset('/js/lightbox.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>


</head>
<body style="background-color:{{$color}}">

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" style="font-size:50px;">{{$site->sitename}}</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li ><a href="#section1" onclick="return show('section1','section2','section3','section4','section5');">Home</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle"  href="#section2" onclick="return show('section2','section1','section3','section4','section5');">Posts</a>
                </li>
                <li><a href="#section3" onclick="return show('section3','section1','section2','section4','section5');">Gallery</a></li>
                <li><a href="#section4" onclick="return show('section4','section1','section2','section3','section5');">Event Calender</a></li>
                <li><a href="#section5" onclick="return show('section5','section1','section2','section3','section4');">Contacts</a></li>

            </ul>

        </div>
    </div>
</nav>

<div class="container">
    <div id="section1">
        <div class="container">
            <div class="jumbotron">
                <img src="{{url('img/1.jpg')}}" style="height:400px;width:900px;">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>About Me</h1>
                            @foreach($about as $val)
                            <div class="well">Name : {{$val->name}}</div>
                            <br>
                            <div class="well">Age : {{$val->age}}</div>
                            <br>
                            <div class="well">Qualifications : {{$val->qualifications}}</div>
                            <br>
                            <p style="text-align: justify">{{$val->about}}</p>
                           @endforeach
                        </div>

                    </div>

            </div>
        </div>

    </div>
    <div id="section2" >

        @foreach($post as $value)


            <div class="col-md-12" style="background-color:white;margin-bottom:20px;">
                 <img class="img-circle" src="/img/user1-128x128.jpg" alt="user image" style="width:40px;height:40px;float:left;">
                 <p style="color:#72afd2;">{{$user}}</p>
                 Shared {{$value->created_at}}

                 <div class="box-body" style="margin-top:10px;margin-bottom:10px;">
                    {!!$value->description!!}
                    <button class="btn btn-default btn-xs modalbtn" value="{{$value->id}}"><i class="fa fa-share" aria-hidden="true" ></i> Comment</button>
                    <button class="btn btn-default btn-xs getCom" value="{{$value->id}}" ><i class="fa fa-share" aria-hidden="true" ></i>ViewComments</button>

                 </div>

                 <div class="box-footer box-comments">
                  <div id="box-comment{{$value->id}}">
                    <!-- User-->
                    <!-- /.comment-text -->
                  </div><!-- /.box-comment -->

                </div>

            </div>


            <div id="{{$value->id}}" class="modal fade" >
              <div class="modal-dialog" role="document">
                <!-- Modal content-->
                <div class="modal-content">
                  <!-- <form method="post" action="{{route('comments.store',$value->id)}}" style="margin-left:30px;margin-right:30px;">
                    {{csrf_field()}} -->
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name{{$value->id}}">
                        <div id="valname{{$value->id}}"></div>
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email{{$value->id}}">
                        <div id="valemail{{$value->id}}"></div>
                      </div>
                      <div class="form-group">
                        <label for="comment">Comment:</label>
                        <textarea class="form-control " rows="5" id="comment{{$value->id}}"></textarea>
                        <div id="valcomment{{$value->id}}"></div>
                      </div>
                      <div>

                        <input type="hidden" id="hidsite" name="sitename" value="{{$value->sitename}}">
                        <input type="hidden" id="hiddescript"name="image" value="{{$value->description}}">

                      </div>
                      <button type="submit" class="btn btn-success submit"  value="{{$value->id}}">Submit</button>
                <!-- </form> -->
              </div>
            </div>
          </div>

        @endforeach


    </div>





    <div id="section3">

        <div class="container">
        <div class="jumbotron">
        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">Thumbnail Gallery</h1>
            </div>
            <div class="collapse navbar-collapse" >
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#"><b><div  id="albumName"></div></b></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories<span class="caret"></span></a>
                        <ul class="dropdown-menu">

                            @foreach($albums as $album)
                            <li><a onClick="changeAlbum('{{ $album->name }}')">{{ $album->name }}</a></li>
                            @endforeach

                        </ul>
                    </li>
                </ul>
                </ul>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div id="messages">
                        @if (Session::has('message'))
                            <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        @if (Session::has('error-message'))
                            <div class="alert alert-danger">{{ Session::get('error-message') }}</div>
                        @endif
                    </div>
                    <div id="searchResults"></div>
                </div>
            </div>
        </div>
            </div>
        </div>

    </div>

    <div id="section4">

    <h3 style="text-align: center"><b>EVENT CALENDAR</b></h3>
    <div class="col-md-12" id="hide">
        <div class="col-md-1"></div>
        <div class="col-md-11" style="align-items: center;">
            <!-- <form name="calender" action="{{ route('site.index')  }}" method="post">
                {{csrf_field()}} -->
                <input style="background-color: #ea716e" class="btn btn-default" align="center" type="submit" name="change" value="TODAY">

                <table border="1" style="border: inset rgba(59, 59, 59, 0.49); height: 100%">
                    <tr style="background-color: #4e5154">
                        <td align="center"><input type="submit" name="change" value="PREVIOUS"></td>
                        <b><td colspan="5" align="center"><input id="month" style="text-align: center" type="text" name="month_num" value="{{$month}}" readonly><input style="text-align: center" type="text" name="month" value="{{$month_name}}" readonly><input id="year" style="text-align: center" type="text" name="year" value="{{$year}}" readonly></td></b>
                        <td align="center"><input type="submit" name="change" value="NEXT" id="next"></td>

                    </tr>
                    <tr style="background-color: #02cbdf"><b>
                            <td width="100px" align="center">SUN</td>
                            <td width="100px" align="center">MON</td>
                            <td width="100px" align="center">TUE</td>
                            <td width="100px" align="center">WED</td>
                            <td width="100px" align="center">THR</td>
                            <td width="100px" align="center">FRI</td>
                            <td width="100px" align="center">SAT</td>
                        </b></tr>
                    <tr style="height: 50px">
                        <? $a=0; ?>
                        @for($i = 1;$i<$num_days+1;$i++,$a++)
                            @if($i == 1)
                                @for($j = 0;$j<date("w",strtotime("$year-$month-$i"));$j++,$a++)
                                    <td>&nbsp;</td>
                                @endfor
                            @endif
                            @if($a%7==0)
                    </tr><tr style="height: 50px">
                        @endif
                        <?php $count=0;if($i<10){$i="0".$i;} ?>

                        @foreach($event_list as $event)
                            @if($event->event_start_date == $year."-".$month."-".$i && $i==$c_day&&$year==$c_year&&$month==$c_month)
                                <div id="replyModal{{$year."-".$month."-".$i}}" class="modal fade" role="dialog" style="z-index: 1400;">
                                    <div class="modal-dialog modal-lg">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><b>EVENT LIST - </b>{{$year."-".$month."-".$i}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <button style=" background-color: #01ff70" title="" type="button" class="btn btn-default" data-toggle="modal" data-target="#test2{{$year."-".$month."-".$i}}">My Events</button>
                                                <button style=" background-color: #00d8ff" title="" type="button" class="btn btn-default" data-toggle="modal" data-target="#test3{{$year."-".$month."-".$i}}">Others' Events</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="test2{{$year."-".$month."-".$i}}" class="modal fade" role="dialog" style="z-index: 1600;">
                                    <div class="modal-dialog modal-lg">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><b>MY EVENTS - </b>{{$year."-".$month."-".$i}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                @foreach($event_list as $event)
                                                    @if($event->event_start_date == $year."-".$month."-".$i && $event->user_id ==$loged_user)
                                                        <div style="background-color:#42dca3">
                                                            Event ID          :<b>{{$eventid = $event->id}}</b><br>
                                                            Event Owner       : <b style="font-size: small;text-transform: uppercase">{{$event->user_name}}</b><br>
                                                            Event Title       : <b style="font-size: large;text-transform: capitalize">{{$event->title}}</b> <br>
                                                            Event Description : <b style="word-wrap: break-word">{{$event->description}}</b><br>
                                                            Event Time :  <b style="word-wrap: break-word">{{$event->s_time}}H - {{$event->e_time}}H</b><br>
                                                            Event Venue : <b style="word-wrap: break-word">{{$event->venue}}</b><br>
                                                        </div>
                                                        <br>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="test3{{$year."-".$month."-".$i}}" class="modal fade" role="dialog" style="z-index: 1600;">
                                    <div class="modal-dialog modal-lg">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><b>OTHERS' EVENTS - </b>{{$year."-".$month."-".$i}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                @foreach($event_list as $event)
                                                    @if($event->event_start_date == $year."-".$month."-".$i && $event->user_id !=$loged_user)
                                                        <div style="background-color:#7adddd">
                                                            Event Owner       : <b style="font-size: small;text-transform: uppercase">{{$event->user_name}}</b><br>
                                                            Event Title       : <b style="font-size: large;text-transform: capitalize">{{$event->title}}</b> <br>
                                                            Event Description : <b style="word-wrap: break-word">{{$event->description}}</b><br>
                                                            Event Time :  <b style="word-wrap: break-word">{{$event->s_time}}H - {{$event->e_time}}H</b><br>
                                                            Event Venue : <b style="word-wrap: break-word">{{$event->venue}}</b><br>
                                                        </div>
                                                        <br>
                                                    @endif
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <?php $count++ ?><td width="100px" align="center"><button style="width: 100px;border: outset rgba(26, 255, 28, 1); background-color: #eac36e" title="click here to add event" type="button" class="btn btn-default" data-toggle="modal" data-target="#replyModal{{$year."-".$month."-".$i}}">{{$i}}</button></td>@break;

                            @elseif($event->event_start_date == $year."-".$month."-".$i)
                                <div id="replyModal{{$year."-".$month."-".$i}}" class="modal fade" role="dialog" style="z-index: 1400;">
                                    <div class="modal-dialog modal-lg">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><b>EVENT LIST - </b>{{$year."-".$month."-".$i}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <button style=" background-color: #01ff70" title="" type="button" class="btn btn-default" data-toggle="modal" data-target="#test2{{$year."-".$month."-".$i}}">My Events</button>
                                                <button style=" background-color: #00d8ff" title="" type="button" class="btn btn-default" data-toggle="modal" data-target="#test3{{$year."-".$month."-".$i}}">Others' Events</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="test2{{$year."-".$month."-".$i}}" class="modal fade" role="dialog" style="z-index: 1600;">
                                    <div class="modal-dialog modal-lg">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><b>MY EVENTS - </b>{{$year."-".$month."-".$i}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                @foreach($event_list as $event)
                                                    @if($event->event_start_date == $year."-".$month."-".$i && $event->user_id == $loged_user)
                                                        <div style="background-color:#42dca3">
                                                            Event ID          :<b>{{$event->id}}</b><br>
                                                            Event Owner       : <b style="font-size: small;text-transform: uppercase">{{$event->user_name}}</b><br>
                                                            Event Title       : <b style="font-size: large;text-transform: capitalize">{{$event->title}}</b> <br>
                                                            Event Description : <b style="word-wrap: break-word">{{$event->description}}</b><br>
                                                            Event Time :  <b style="word-wrap: break-word">{{$event->s_time}}H - {{$event->e_time}}H</b><br>
                                                            Event Venue : <b style="word-wrap: break-word">{{$event->venue}}</b><br>
                                                        </div>
                                                        <br>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div id="test3{{$year."-".$month."-".$i}}" class="modal fade" role="dialog" style="z-index: 1600;">
                                    <div class="modal-dialog modal-lg">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><b>OTHERS' EVENTS - </b>{{$year."-".$month."-".$i}}</h4>
                                            </div>
                                            <div class="modal-body">
                                                @foreach($event_list as $event)
                                                    @if($event->event_start_date == $year."-".$month."-".$i && $event->user_id != $loged_user)
                                                        <div style="background-color:#7adddd">
                                                            Event Owner       : <b style="font-size: small;text-transform: uppercase">{{$event->user_name}}</b><br>
                                                            Event Title       : <b style="font-size: large;text-transform: capitalize">{{$event->title}}</b> <br>
                                                            Event Description : <b style="word-wrap: break-word">{{$event->description}}</b><br>
                                                            Event Time :  <b style="word-wrap: break-word">{{$event->s_time}}H - {{$event->e_time}}H</b><br>
                                                            Event Venue : <b style="word-wrap: break-word">{{$event->venue}}</b><br>
                                                        </div>
                                                        <br>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <?php $count++ ?><td width="100px" align="center"><button style="width: 100px; background-color: #eac36e" title="" type="button" class="btn btn-default" data-toggle="modal" data-target="#replyModal{{$year."-".$month."-".$i}}">{{$i}}</button></td>@break;
                            @endif
                        @endforeach
                        @if($count==0)
                            @if($i == $c_day&&$year == $c_year&&$month == $c_month)
                                <td width="100px" align="center"><button style="width: 100px; border: outset rgba(26, 255, 28, 1)" title="" type="button" class="btn btn-default" data-toggle="modal" data-target="#replyModal{{$year."-".$month."-".$i}}">{{$i}}</button></td>
                            @else
                                <td width="100px" align="center"><button style="width: 100px" title="" type="button" class="btn btn-default" data-toggle="modal" data-target="#replyModal{{$year."-".$month."-".$i}}">{{$i}}</button></td>
                            @endif
                        @endif
                        @endfor
                    </tr>
                </table>
            <!-- </form> -->
            <br><br>


        </div>
        <div class="col-md-2"></div>
    </div>


    </div>

    <div id="section5">

        <div class='box'>

            <div class="row col-md-12 jumbotron">
                <div class="col-md-8">
                    <h2>My Social Profiles.</h2>

                    <ul class="list-inline banner-social-buttons">
                        <li>
                            <a href="https://twitter.com/SBootstrap" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                        </li>
                        <li>
                            <a href="https://github.com/IronSummitMedia/startbootstrap" class="btn btn-default btn-lg"><i class="fa fa-facebook fa-fw"></i> <span class="network-name">Facebook</span></a>
                        </li>
                        <li>
                            <a href="https://plus.google.com/+Startbootstrap/posts" class="btn btn-default btn-lg"><i class="fa fa-google-plus fa-fw"></i> <span class="network-name">Google+</span></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h2>My Tweeter Feed</h2>
                    <div class="box">

                        @foreach($twitter as $wds)

                                <div class="box-body">
                                    {!!html_entity_decode($wds->code)!!}
                                </div>

                        @endforeach

                    </div>
                </div>
                <div id="contact-us" class="parallax">
                    <div class="container">
                        <div class="row">
                            <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                                <h2>Connect With Me..</h2>
                                <p>If you have anything to ask from me.Feel free to send me a message</p>
                            </div>
                        </div>
                        <div class="contact-form wow fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms">
                            <div class="row">
                                <div class="col-sm-12">

                                    <form id="main-contact-form" name="contact-form" method="post" action="{{ url('templates/mail')  }}">

                                        {{ csrf_field() }}

                                        <div class="row  wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="text" name="name" class="form-control" placeholder="Name" required="required">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input type="email" name="email" class="form-control" placeholder="Email Address" required="required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="subject" class="form-control" placeholder="Subject" required="required">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="message" id="message" class="form-control" rows="4" placeholder="Enter your message" required="required"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn-success" name="submit">Send Now</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-12">
                                    <div class="contact-info wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>--}}
                                        {{--<ul class="address">--}}
                                        <i class="fa fa-map-marker"></i> <span> Address:</span> 2400 South Avenue A<span> </span>
                                        <i class="fa fa-phone"></i> <span> Phone:</span> +928 336 2000<span> </span>
                                        <i class="fa fa-envelope"></i> <span> Email:</span><a href="mailto:someone@yoursite.com"> support@oxygen.com</a><span> </span>
                                        <i class="fa fa-globe"></i> <span> Website:</span> <a href="#">www.sitename.com</a><span> </span>
                                        {{--</ul>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

</div>

<script>

    $(document).ready(function(){






      var email=null,name=null
        // $( "#section1" ).hide();
        $( "#section2" ).hide();
        $( "#section3" ).hide();
        $( "#section4" ).hide();
        $( "#section5" ).hide();

        $(".modalbtn").click(function(){
    var a=$(this).val();
    $("#"+a).modal();
});

/**
 * Validatename field
 *
 * @param value of namefield
 * @return true if valid
 */
function validateName(nameval)
{
    var n=false;

    var namereg=new RegExp("^[a-zA-Z]{3,16}$");
    if(namereg.test(nameval))
    {
        n=true;
        return n;
    }
}

/**
 * Validate email field
 *
 * @param value of emailfield
 * @return true if valid
 */
function validateEmail(emailval)
{
    var e=false;
    var emailreg=new RegExp("^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$");
    if(emailreg.test(emailval))
    {
        e=true;
        return e;
    }
}

/**
 * Detects change in email field and validate
 * by calling validateEmail() method
 */
// $("#email").change(function(){
//
//     email=$('#email').val();
//     if(!validateEmail(email))
//     {
//         $("#valemail").html("<p style='color:red;'><b>Invalid Email Address</b></p>");
//         email=null;
//     }
//     else {
//         $("#valemail").html(" ");
//     }
//
// });
//
// /**
// 	 * Detect changes in name field and validate
//  * by calling validateName() method
//  */
// $("#name").change(function(){
//
//     name=$('#name').val();
//     if(!validateName(name))
//     {
//         $("#valname").html("<p style='color:red;'><b>Invalid Input</b></p>");
//         name=null;
//     }
//     else {
//         $("#valname").html(" ");
//     }
// });

$(".submit").click(function(){


    var id=$(this).val();
    var comment=$("#comment"+id).val();

    name=$('#name'+id).val();
    if(!validateName(name))
    {
        $("#valname"+id).html("<p style='color:red;'><b>Invalid Input</b></p>");
        name=null;
    }
    else {
        $("#valname"+id).html(" ");
    }

    email=$('#email'+id).val();
    if(!validateEmail(email))
    {
        $("#valemail"+id).html("<p style='color:red;'><b>Invalid Email Address</b></p>");
        email=null;
    }
    else {
        $("#valemail"+id).html(" ");
    }


    if((email != null) & (name != null) & (comment != ''))
    {
        var sitename=$("#hidsite").val();
        var url="{!!route('comments.store')!!}";

        $.ajax({
            url:url,
            type:'GET',
            data:{"e":email,"n":name,"c":comment,"s":sitename,"p":id},
            success:function(data){
                if(data==1)
                {
                    swal({
                        title:'',
                        text:"Comment sent for approval",
                        timer:2000
                        });
                }
                else {
                    swal({
                        title:'',
                        text:"Commenting erro",
                        timer:2000
                        });
                }

                }


        });

    }
    else {
        swal({
            title:'',
            text:"Fields cannot be empty",
            timer:2000
            });
    }


});

$(".getCom").click(function(){
    var postID=$(this).val();
    var uri="{!!url('/getComments')!!}";
    $.ajax({
        url:uri,
        type:'GET',
        data:{pid:postID},
        success:function(data){
            $("#box-comment"+postID).html(data);


        }
    });


});

    });
        // document.getElementById("#section1").style.display='block';
        // document.getElementById("#section2").style.display='none';
        // document.getElementById("#section3").style.display='none';
        // document.getElementById("#section4").style.display='none';
        // document.getElementById("#section5").style.display='none';


    function show(shown, hidden,hidden1,hidden2,hidden3) {
        document.getElementById(shown).style.display='block';
        document.getElementById(hidden).style.display='none';
        document.getElementById(hidden1).style.display='none';
        document.getElementById(hidden2).style.display='none';
        document.getElementById(hidden3).style.display='none';
        return false;
    }

</script>

</body>
</html>
