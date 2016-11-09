@extends('app')

{{--scripts--}}
@section('scripts')
    <script src="/js/jquery.validate.js"></script>
    <script src="/js/userstory-validation.js"></script>
    <script src="/js/bootbox.js"></script>
    <script src="/js/profile.js"></script>
    <!-- InputMask -->
    <!-- Select2 -->
    <script src="{{ asset('/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.js')}}"></script>
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>


    <script>
        $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();

            //Datemask dd/mm/yyyy
            $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
            //Datemask2 mm/dd/yyyy
            $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
            //Money Euro
            $("[data-mask]").inputmask();


        });
    </script>

@stop

{{--css files--}}
@section('links')
    <link href="/css/project-custom.css" rel="stylesheet">
@stop


@section('content')
@section('pageName')
    Edit Profile Details
@stop
{{--breadcrumb--}}
@section('breadcrumbs')
    {!! Breadcrumbs::render('edit',$userDetails[0]->id) !!}
@stop
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    {{--display developer/pm/client selected individual project details--}}
                    @include('profile.partials.form', ['formType' => 'edit'])
                </div>
            </div>
        </div>
    </div>
@stop