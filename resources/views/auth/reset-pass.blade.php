@include('includes.header')
        <!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo">
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
<div class="row" style="margin-top: 10%; text-align: center;">
    <h1> Profiler.NET</h1>
    <h3>Password Reset</h3>

    <!-- Display any messages from Session Flash -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    @if (Session::has('error-message'))
        <div class="alert alert-danger">{{ Session::get('error-message') }}</div>
    @endif
                <hr/>

    <form method="POST" action="/auth/reset-password" class="form-horizontal" id="reset-password-form">
        {!! csrf_field() !!}


        <div class="form-group col-md-12">
            <label for="email" class="col-md-2 control-label">Email</label>
            <div class="col-md-10">
                <input type="email" name="email" value="{{ old('email') }}" class="form-control col-md-6" required="" autofocus="" placeholder="Email Address">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-2">
                <button type="submit" class="btn btn-sm btn-danger">Reset Password</button>
            </div>
        </div>
    </form>
    </div>

@include('includes.footer')