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
            <a class="navbar-brand" href="#">{{$site->sitename}}</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#" onclick="return show('section1','section2','section3','section4');">Home</a></li>
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
        <div>
            <img src="{{url('img/home-bg.jpg')}}" style="height:400px;width:900px;">
        </div>
        <div>
                <br>
                <div class="well">Name : {{$about->name}}</div>

                <br>
                <div class="well">Age : {{$about->age}}</div>

                <br>
                <div class="well">Experience : {{$about->qualifications}}</div>

                <br>
                <div class="well">About Me : {{$about->about}}</div>

        </div>
    </div>
    <div id="section2">
        <br>
        <img src="{{asset('resources/assets/img/postimages/'.$post->image)}}" style="width:400px;height: 300px">

        <div class="well" style="margin-top:10px">
            <p>{{$post->description}}</p>
        </div>

        <input type="comment" class="btn btn-success btn-sm" value="+Comment">

        <!--model used to add comment-->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal Header</h4>
                    </div>
                    <div class="modal-body">
                        <p>Some text in the modal.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

    </div>
    </div>
    <div id="section3">
        fine
    </div>
    <div id="section4">

    </div>
</div>
<script>
    $(document).ready(function(){
        $("#section2").hide();
        $("#section3").hide();
        $("#section4").hide();

    })
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
