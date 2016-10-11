<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Case</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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
                <li ><a href="#section1" onclick="return show('section1','section2','section3','section4');">Home</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle"  href="#" onclick="return show('section2','section1','section3','section4');">Posts</a>
                </li>
                <li><a href="#" onclick="return show('section3','section1','section2','section4');">Event Calender</a></li>
                <li><a href="#" onclick="return show('section4','section1','section2','section3');">Contacts</a></li>
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
                        <input type="hidden" name="description" value="{{$value->description}}"
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
</body>
</html>
