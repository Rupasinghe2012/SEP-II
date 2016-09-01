@include ('includes.header')
<div class="row" style="margin-top: 10%; text-align: center;">
    <h1 class=""> Profiler.NET</h1>
    <h4 class=""> (Prof.NET)</h4>
    <!--    <p style="margin-bottom: 20px; margin-top: 20px;" class="">Please login to continue. <a href="/auth/reset-password">Click here</a> if you cannot remember your password.</p>-->
    <p style="margin-bottom: 20px; margin-top: 20px;" class="">Please fill the Registraion Form .</p>
    <!--  Check if any messages are being passed into the view  -->
    <hr>
    <div class="row col-md-6 col-md-offset-4">
<form method="POST" action="/auth/register">
    {!! csrf_field() !!}

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="col-sm-4 control-label">Name</label>

        <div class="col-sm-6">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter your Name">

            @if ($errors->has('name'))
                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="col-sm-4 control-label">E-Mail</label>

        <div class="col-sm-6">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter your E-Mail">

            @if ($errors->has('email'))
                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="col-sm-4 control-label">Password</label>

        <div class="col-sm-6">
            <input type="password" class="form-control" name="password" placeholder="Enter a Password">

            @if ($errors->has('password'))
                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <label class="col-sm-4 control-label">Confirm Password</label>

        <div class="col-sm-6">
            <input type="password" class="form-control" name="password_confirmation" placeholder="Re-Type Password">

            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
            @endif
        </div>
    </div>


    <div class="col-sm-6">
        <button class="btn btn-success" type="submit">Register</button>
    </div>


</form>
        </br>
        </br>
        <span>Already have an account?</span>
        <a href="{{ url('auth/login') }}">Login</a>
</div>
    </div>
@include('includes.footer')