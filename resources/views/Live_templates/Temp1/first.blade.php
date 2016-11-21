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
                    <a class="dropdown-toggle"  href="#" onclick="return show('section2','section1','section3','section4','section5');">Posts</a>
                </li>
                <li><a href="#" onclick="return show('section3','section1','section2','section4','section5');">Event Calender</a></li>
                <li><a href="#section4" onclick="return show('section4','section1','section2','section3','section5');">Gallery</a></li>
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
        <div  class="col-md-7 "  >
            <div style="margin-top:40px;" >
                <img src="{{asset('resources/assets/img/postimages/'.$value->image)}}" width="30" height="300" class="col-md-12 " style="margin-bottom:10px;">
                <!-- <input type='text' style='margin-left:15px;' size='85' class="field" postid='{{$value->id}}' sitename="{{$site->sitename}}" placeholder="Write a comment.."> -->
                <input type="button" value="Add Comment" style="margin-left:15px;" class="btn btn-success btn-sm" data-toggle="modal" data-target="#{{$value->id}}">
                <br>
                <a class="getCom" comid="{{$value->id}}" style="margin-left:15px;">View Comments</a>
                <div class="show" style="margin-left:18px;"></div>
            </div>
            <div id="{{$value->id}}" class="modal fade" >
              <div class="modal-dialog" role="document">
                <!-- Modal content-->
                <div class="modal-content">
                  <form method="post" action="{{route('comments.store',$value->id)}}" style="margin-left:30px;margin-right:30px;">
                    {{csrf_field()}}
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name">
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email">
                      </div>
                      <div class="form-group">
                        <label for="comment">Comment:</label>
                        <textarea class="form-control" rows="5" name="comment"></textarea>
                      </div>
                      <div>
                        <input type="hidden" name="sitename" value="{{$value->sitename}}">
                        <input type="hidden" name="image" value="{{$value->image}}">
                        <input type="hidden" name="description" value="{{$value->description}}">
                      </div>
                      <button type="submit" class="btn btn-success" class="comment" post="{{$value->id}}">Submit</button>
                </form>
              </div>
            </div>
          </div>

          </div>
            <!-- <a style='margin-left:15px;' id='{{$value->id}}' class="view">View Comments</a>
            <div style="margin-left:15px;margin-top:10px;" class="{{$value->id}}">
            </div> -->
            @endforeach
        </div>





    <div id="section3">
    </div>
    <div id="section4">
        <!-- Page Content -->
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

    <div id="section5" class="container content-section text-center">
        <div class="row col-md-12">
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

<script>

    $(document).ready(function(){


        $("#section2").hide();
        $("#section3").hide();
        $("#section4").hide();

        $(".getCom").click(function(){
            var postID=$(this).attr("comid");
            var uri="{!!url('/getComments')!!}";
            $.ajax({
                url:uri,
                type:'GET',
                data:{pid:postID},
                success:function(data){
                    $(".show").html(data);
                }
            });



        });

    });

    function show(shown, hidden,hidden1,hidden2) {
        document.getElementById(shown).style.display='block';
        document.getElementById(hidden).style.display='none';
        document.getElementById(hidden1).style.display='none';
        document.getElementById(hidden2).style.display='none';
        return false;
    }
</script>
            <script src="{{ asset('/js/Gimages.js') }}"></script>
            <script src="{{ asset('/js/lightbox.js')}}"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
</body>
</html>
