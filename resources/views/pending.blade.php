@extends('app')



    @section('content')

            <!-- Display any messages from Session Flash -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    @if (Session::has('error-message'))
        <div class="alert alert-danger">{{ Session::get('error-message') }}</div>
    @endif

    <table class="table table-hover table-striped">

        <thead>
        <th class="col-lg-1">ID</th>
        <th class="col-lg-1">Date</th>
        <th class="col-lg-4">Description</th>
        <th class="col-lg-1">Status</th>
        <th class="col-lg-1">Created</th>
        <th class="col-lg-1">Updated</th>
        <th class="col-lg-1"> </th>

        </thead>
        <tbody>

        @forelse ($preorders as $preorder)
            <tr>

                <td> {{ $preorder->preorder_id }} </td>
                <td> {{ $preorder->ready_time }} </td>
                <td> {{ (strlen($preorder->description) > 70 ? substr($preorder->description, 0, 70).'...' : $preorder->description)  }} </td>
                <td> {{ $preorder->status }} </td>
                <td> {{ $preorder->created_at->diffForHumans() }} </td>
                <td> {{ $preorder->updated_at->diffForHumans() }} </td>
                <td> <a class="btn btn-primary btn-default" href="{{ URL::to('preorder/show/'.$preorder->preorder_id) }}">Show</a>
            </tr>

        @empty
            <div class="alert alert-danger">
                <i class="fa fa-2x fa-fw fa-exclamation-triangle"></i>No pending preorders
            </div>
        @endforelse

        </tbody>
    </table>

    <!-- confirmCancel Modal -->
    <div id="confirmCancel" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title">Are you sure?</h2>
                </div>
                <div class="modal-body">
                    <p>This will send a cancel request to the store.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

@section('notifications')
    @include('includes.notification')
@stop

@section('scripts')
    <script src="{{ URL::asset('js/preorder_script.js') }}"></script>
@stop

@endsection