@extends('app')



@section('content')
    <div class="row">
        <h3 style="text-align: center">Template Data Table</h3>
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
                                </table></div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example2_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="example2_previous"><a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0">6</a></li><li class="paginate_button next" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0">Next</a></li></ul></div></div></div></div>
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