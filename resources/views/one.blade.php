@extends('app')



    @section('content')


            <!-- Display any messages from Session Flash -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    @if (Session::has('error-message'))
        <div class="alert alert-danger">{{ Session::get('error-message') }}</div>
    @endif
<div class="">
    <a href="../pending"><button class="btn btn-primary">Go Back</button></a>
</div>

    <div class="box">
        <div class="box-header">
            <h2>Showing preorder made on {{ $preorder->created_at->diffForHumans() }}</h2>
        </div>
        <div class="box-body">
            <div class="form-horizontal col-md-3 col-md-offset-2">


                <div class="form-group">
                    <p> <b>Preorder ID: </b> {{ $preorder->preorder_id }} </p>
                </div>
                <div class="form-group">
                    <p> <b>Ready time: </b> {{ $preorder->ready_time }} </p>
                </div>
                <div class="form-group">
                    <p> <b>Description: </b>{{ $preorder->description }} </p>
                </div>
                <div class="form-group">
                    <p> <b>Status: </b> {{ $preorder->status }} </p>
                </div>
                <div class="form-group">
                    <p> <b>Created at: </b> {{ $preorder->created_at->diffForHumans() }} </p>
                </div>
                <div class="form-group">
                    <p> <b>Updated at: </b> {{ $preorder->updated_at->diffForHumans() }} </p>
                </div>
                <div class="form-group">
                    <p> <b>Total: </b> {{ $preorder->value }} </p>
                </div>
                <div class="form-group">
                    <p> <b>Paid: </b> @if ( $preorder->paid==0 )  Not paid @else Not Paid @endif </p>
                </div>


                <div class="form-group">
                    <form class="form-horizontal col-md-3 col-md-offset-2" role="form" method="POST" action="{{ url('preorder/'.$preorder->preorder_id) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE" }}>
                        <button type="submit" class="btn btn-danger">
                            @if ($userData == "client")
                                Cancel order
                            @else
                                Reject order
                            @endif
                        </button>
                    </form>
                    <form class="form-horizontal col-md-3 col-md-offset-2" role="form" method="POST" action="{{ url('preorder/buy/'.$preorder->preorder_id) }}">
                        {{ csrf_field() }}
                            <button type="submit" class="btn btn-success">
                                Buy
                            </button>
                        </form>

                    </div>
                </div>

        </div>
    </div>
    <div class="container">



        </div>

    @if (/*!$items->isEmpty()*/true)
        <table class="table table-bordered" id="tblItems">

            <thead>
            <th class="col-lg-1">Description</th>
            <th class="col-lg-1">Unit Value</th>
            <th class="col-lg-4">Quantity</th>
            <th class="col-lg-1">Total</th>

            </thead>
            <tbody>
            @endif
            @forelse ($items as $item)
                <tr>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->uvalue }}</td>
                    <td>{{ $item->qty }}</td>
                    <td class="item-total">{{ $item->uvalue*$item->qty }}</td>
                </tr>
            @empty
                <div class="alert alert-info">No items in preorder.</div>
            @endforelse
    </div>

            @section('notifications')
                @include('includes.notification')
            @stop

            @section('scripts')
                <script src="{{ URL::asset('js/preorder_script.js') }}"></script>
        @stop

        @endsection