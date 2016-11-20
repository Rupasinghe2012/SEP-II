@extends('app')


@section('pageName')
    <h3 style="text-align: center"><b>TEMPLATE DETAILS</b></h3>
@stop
{{--breadcrumb--}}
@section('breadcrumbs')
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/admin/home')}}">Home /</a>
        <span class="breadcrumb-item active">Temp Details</span>
    </nav>
@stop
@section('content')

    <div class="row">
        {{--<h3 style="text-align: center"><b>TEMPLATE DETAILS</b></h3>--}}
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                    <thead>
                                    <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Template ID: activate to sort column descending">Template ID</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">Name</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Description: activate to sort column ascending">Description</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Colour: activate to sort column ascending">Colour</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="price: activate to sort column ascending">Price</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Image: activate to sort column ascending">Image</th> </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($templates as $template)
                                        <tr role="row" class="">

                                            <td>{{ $template->id }}</td>
                                            <td>{{ $template->name }}</td>
                                            <td>{{ $template->description }}</td>
                                            <td><span style="color:{{ $template->colour }};zoom: 2.0">&#9733</span></td>
                                            <td>{{ $template->price }}</td>
                                            <td><a href="{{ asset("resources/views/upload_temp/" .$template->temp_source) }}" target="_blank"><img src='{{asset("/images/previews/" . $template->temp_pic )  }}' alt="MountainView" style="width:100px;height:50px;"></a></td>
                                            <td style="text-align: center"><a href={{url("templates/". $template->id ."/edit") }}><button title="click here to edit template" type="button" class="btn btn-warning" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a></td>
                                            <td style="text-align: center"><a href={{url("templates/". $template->id ."/delete") }}><button title="click here to remove template" type="button" class="btn btn-danger" onclick="return confirm('Are you sure to DELETE this template?');"><i class="fa fa-times" aria-hidden="true"></i></button></a></td>

                                        </tr>
                                    @endforeach
                                </table></div></div>

                        <div class="row">
                            <div class="col-sm-5">
                                <div class="dataTables_info" id="example2_info" role="status" aria-live="polite"></div>
                            </div>
                            <div class="col-sm-7">
                                <div>
                                    {{$templates->render()}}
                                </div>
                            </div></div></div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@section('notifications')
    @include('includes.notification')
@stop


@endsection