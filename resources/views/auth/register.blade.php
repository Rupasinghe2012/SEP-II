
@include('includes.header')
        <!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/') }}"class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>Prof</b>.net</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Profiler</b>.net</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        </div>
    </nav>
</header>
@section('scripts')
    <script src="/js/jquery.validate.js"></script>
    <script src="/js/userstory-validation.js"></script>
    @stop
<div class="row" style="margin-top: 10%; text-align: center;">
    <h1 class=""> Profiler.NET</h1>
    <p style="margin-bottom: 5px; margin-top: 5px;" class="">Please fill the Registraion Form .</p>
    <hr>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><span
                            class="caption-subject font-blue-madison bold uppercase">Register</span></div>
                <div class="panel-body">
<form method="POST" id="userStoryForm" action="/auth/register">
    {!! csrf_field() !!}

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Name</label>

        <div class="col-md-6">
            <input type="text" class="form-control" name="name" id="Name" value="{{ old('name') }}" placeholder="Enter your Name">

            @if ($errors->has('name'))
                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">E-Mail</label>

        <div class="col-md-6">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter your E-Mail">

            @if ($errors->has('email'))
                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Password</label>

        <div class="col-md-6">
            <input type="password" class="form-control" id="newPassword" name="password" placeholder="Enter a Password">

            @if ($errors->has('password'))
                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Confirm Password</label>

        <div class="col-md-6">
            <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Re-Type Password">

            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">

            {!! captcha_image_html('RegisterCaptcha') !!}
            <input type="text" class="form-control" name="CaptchaCode" id="CaptchaCode">
            @if ($errors->has('CaptchaCode'))
                <span class="help-block">
                                        <strong>{{ $errors->first('CaptchaCode') }}</strong>
                                    </span>
            @endif
        </div>
    </div>


    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-user"></i>Register
            </button>
        </div>
    </div>


</form>
        </br>
        </br>
        <span>Already have an account?</span>
        <a href="{{ url('auth/login') }}">Login</a>
</div>
    </div>
            </div>
        </div></div>
@include('includes.footer')