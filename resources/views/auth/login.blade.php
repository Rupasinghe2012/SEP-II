@include('includes.header')
<div class="row" style="margin-top: 10%; text-align: center;">
        <h1 class=""> Profiler.NET</h1>
        <h4 class=""> (Prof.NET)</h4>
        <!--    <p style="margin-bottom: 20px; margin-top: 20px;" class="">Please login to continue. <a href="/auth/reset-password">Click here</a> if you cannot remember your password.</p>-->
        <p style="margin-bottom: 20px; margin-top: 20px;" class="">Please login to continue.</p>
        <!--  Check if any messages are being passed into the view  -->
        @if(session('message'))
            <div class="alert alert-info">
                {{ session('message') }}
            </div>
            @endif
                    <!--  Check if any warnings are being passed into the view  -->
            @if(session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
                @endif
                        <!--  Check if any errors are being passed into the view  -->
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                            <!--  Check if any validation errors are being passed into the view  -->
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                    <hr/>
                    <div class="row col-md-4 col-md-offset-4">
                        <form method="POST" action="/auth/login" class="form-horizontal" id="login-form" role="form">
                            {!! csrf_field() !!}
                            <label for="inputEmail" class="sr-only">Email address</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required="" autofocus="" placeholder="Email Address">
                            <label for="inputPassword" class="sr-only">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Remember Me
                                </label>
                            </div>
                            <a class="btn btn-link" href="{{ url('/auth/reset-password') }}">Forgot Your Password?</a>
                            </br></br>
                            <button class="btn btn-sm btn-primary btn-block" type="submit">Sign in</button>
                        </form>
                        </br></br>
<span>Looking to
                                 <a href="{{ url('auth/register') }}">create an account</a>
                            ?</span>
                    </div>

    </div>
@include('includes.footer')