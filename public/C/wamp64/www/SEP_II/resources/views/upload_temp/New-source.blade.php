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
<body style="background-color: lightslategra">

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">WebSiteName</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#section1" onclick="return show('section1','section2','section3','section4');">Home</a></li>
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
                <img src="{{url('img/home-bg.jpg')}}" style="height:400px;width:900px;">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>About Me</h1>

                            <div class="well">Name : user information goes here user information goes here user information goes here</div>
                            <br>
                            <div class="well">Age : user information goes here user information goes here user information goes here</div>
                            <br>
                            <div class="well">Qualifications : user information goes here user information goes here user information goes here</div>
                            <br>
                            <p style="text-align: justify">As Prime Minister and in her previous role as Deputy Prime Minister,
                                Ms Gillard was central to the successful management of Australia’s economy,
                                the 12th biggest economy in the world, during the Global Financial Crisis and as Australia positioned to seize the benefits of Asia’s rise.
                                Ms Gillard developed Australia’s guiding policy paper, Australia in the Asian Century.
                                Ms Gillard delivered nation-changing policies including reforming Australian education at every level from early childhood to university education,
                                creating an emissions trading scheme, improving the provision and sustainability of health care, aged care and dental care, commencing the nation’s first ever national scheme to care for people with disabilities and restructuring the telecommunications sector as well as building the National Broadband Network.
                                In foreign policy, Ms Gillard strengthened Australia’s alliance with the United States, secured stronger architecture for the relationship with China, upgraded Australia’s ties with India, and deepened ties with Japan, Indonesia and South Korea. Ms Gillard has represented Australia at the G20,
                                including winning Australia’s right to host the 2014 meeting, the East Asia Summit, APEC, NATO-ISAF and chaired CHOGM. Under Ms Gillard’s leadership,
                                Australia was elected to serve on the United Nations Security Council.</p>

                        </div>

                    </div>

            </div>
        </div>
    </div>
    <div id="section2">
        <div>
            <img src="{{asset('img/post-bg.jpg')}}" style="width:800px;height: 400px">

            <div class="well">

                <p>Never in all their history have men been able truly to conceive of the world as one: a single sphere,
                    a globe, having the qualities of a globe, a round earth in which all the directions eventually meet,
                    in which there is no center because every point, or none, is center — an equal earth which all men occupy as equals.
                    The airman's earth, if free men make it, will be truly round: a globe in practice, not in theory.</p>
            </div>
        </div>
    </div>
    <div id="section3">
        Calender
    </div>
    <div id="section4">
        <div class="well"><input type="button" name="contact" value="Contact US"></div>
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
