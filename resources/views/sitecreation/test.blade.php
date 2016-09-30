@extends('app')
@section('content')

    @if(Session::has('site'))
        <div class="alert alert-success" role="alert">
          {{Session::get('site')}}
        </div>
    @endif
    @if(Session::has('host'))
      <div class="alert alert-success" role="alert">
        {{Session::get('host')}}
      </div>
    @endif

    <form  role="form" method="POST" action="{{url('/insert/'.$id)}}" class="create" id="siteform" data-parsley-validate="">

                {{ csrf_field() }}

                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" required="" data-parsley-pattern="[A-Za-z]*" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="name" value={{old('name')}} >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Age</label>
                        <input type="text" required="" data-parsley-type="digits" class="form-control" id="age" placeholder="Age" name="age" value={{old('age')}} >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Qualifications</label>
                        <textarea required="" data-parsley-pattern="[A-Za-z]*" class="form-control" rows="3" placeholder="Enter ..." name="qualifications"  value={{old('qualifications')}} ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">About You</label>
                        <textarea required="" data-parsley-pattern="[A-Za-z]*" class="form-control" rows="3" placeholder="Enter ..." name="about" >{{old('about')}}</textarea>
                    </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">SiteName</label>
                        <input required="" data-parsley-pattern="[A-Za-z]*" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="sitename" value={{old('sitename')}} >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">HostName</label>
                        <input required="" data-parsley-pattern="[A-Za-z]*" type="text"  class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="hostname" value={{old('hostname')}} >
                    </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="create">Create Site</button>
                </div>
    </form>
@endsection
