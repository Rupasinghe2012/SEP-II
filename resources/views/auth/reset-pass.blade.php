@extends('app')

@section('links')
        <!--<link href="/css/auth/reset-pass.css" rel="stylesheet">-->
@stop

@section('content')
    <h1> Agile Project Management Tool </h1>
    <p>Password Reset</p>

    <form method="POST" action="/auth/reset-password" class="form-horizontal" id="reset-password-form">
        {!! csrf_field() !!}
        @if(isset($error)) {{ $error }} @endif
        @if(Session::get('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif

        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="form-group">
            <label for="email" class="col-md-2 control-label">Email</label>
            <div class="col-md-10">
                <input type="email" name="email" value="" class="col-md-10">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-sm btn-danger">Reset Password</button>
            </div>
        </div>
    </form>
@stop