@include('includes.header')
<div class="row" style="margin-top: 10%; text-align: center;">
    <h1> Profiler.NET</h1>
    <h3>Password Reset</h3>
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