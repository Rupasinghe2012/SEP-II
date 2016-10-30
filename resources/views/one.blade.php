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

    {{--<div class="box">--}}
        {{--<div class="box-header">--}}
            {{--<h2>Showing preorder made on {{ $preorder->created_at->diffForHumans() }}</h2>--}}
        {{--</div>--}}
        {{--<div class="box-body">--}}
            {{--<div class="form-horizontal col-md-3 col-md-offset-2">--}}


                {{--<div class="form-group">--}}
                    {{--<p> <b>Preorder ID: </b> {{ $preorder->preorder_id }} </p>--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--<p> <b>Ready time: </b> {{ $preorder->ready_time }} </p>--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--<p> <b>Description: </b>{{ $preorder->description }} </p>--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--<p> <b>Status: </b> {{ $preorder->status }} </p>--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--<p> <b>Created at: </b> {{ $preorder->created_at->diffForHumans() }} </p>--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--<p> <b>Updated at: </b> {{ $preorder->updated_at->diffForHumans() }} </p>--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--<p> <b>Total: </b> {{ $preorder->value }} </p>--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--<p> <b>Paid: </b> @if ( $preorder->paid==0 )  Not paid @else Not Paid @endif </p>--}}
                {{--</div>--}}


                {{--<div class="form-group">--}}
                    {{--<form class="form-horizontal col-md-3 col-md-offset-2" role="form" method="POST" action="{{ url('preorder/'.$preorder->preorder_id) }}">--}}
                        {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                        {{--<input type="hidden" name="_method" value="DELETE" }}>--}}
                        {{--<button type="submit" class="btn btn-danger">--}}
                            {{--@if ($userData == "client")--}}
                                {{--Cancel order--}}
                            {{--@else--}}
                                {{--Reject order--}}
                            {{--@endif--}}
                        {{--</button>--}}
                    {{--</form>--}}
                    {{--<form class="form-horizontal col-md-3 col-md-offset-2" role="form" method="POST" action="{{ url('preorder/buy/'.$preorder->preorder_id) }}">--}}
                        {{--{{ csrf_field() }}--}}
                            {{--<button type="submit" class="btn btn-success">--}}
                                {{--Buy--}}
                            {{--</button>--}}
                        {{--</form>--}}

                    {{--</div>--}}
                {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}








                <!-- Main content -->
                <section class="invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-globe"></i> Profiler.NET
                                <small class="pull-right"><p id="date"></p></small>
                            </h2>
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong>Profiler.NET</strong><br>
                                200/4<br>
                                Galabada Town<br>
                                Phone: (+94) 123-5432<br>
                                Email: info@Profiler.NET.com
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong>{{Auth::user()->name}}</strong><br>
                                {{Auth::user()->address}}<br>
                                Phone: {{Auth::user()->mobile}}<br>
                                Email: {{Auth::user()->email}}
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <b>Invoice #007612</b><br>
                            <br>
                            <b>Order ID:</b> {{ $preorder->preorder_id }}<br>
                            <b>Payment Due:</b> {{ $preorder->created_at->diffForHumans() }}<br>
                            <b>Account: </b> {{Auth::user()->id}}
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            @if (/*!$items->isEmpty()*/true)
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Qty</th>
                                    <th>Product</th>
                                    <th>Unit value</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @endif
                                @forelse ($items as $item)
                                <tr>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>${{ $item->uvalue }}</td>
                                    <td>${{ $item->uvalue*$item->qty }}</td>
                                </tr>
                                @empty
                                    <div class="alert alert-info">No items in preorder.</div>
                                @endforelse

                                </tbody>
                            </table>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                            <p class="lead">Payment Methods:</p>
                            <img src="/img/credit/visa.png" alt="Visa">
                            <img src="/img/credit/mastercard.png" alt="Mastercard">
                            <img src="/img/credit/american-express.png" alt="American Express">
                            <img src="/img/credit/paypal2.png" alt="Paypal">
                            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                Contact Profiler.Net Team For more Detials
                            </p>
                        </div><!-- /.col -->
                        <div class="col-xs-6">
                            <p class="lead">Amount Due Since {{ $preorder->created_at->diffForHumans() }}</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td>{{ $preorder->value }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>{{ $preorder->value }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            {{--<a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>--}}
                            <form role="form" method="POST" action="{{ url('preorder/'.$preorder->preorder_id) }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE" }}>
                                <button type="submit" class="btn btn-danger pull-right " x>
                                    @if ($userData == "client")
                                        Cancel order
                                    @else
                                        Reject order
                                    @endif
                                </button>
                            </form>
                            <form  role="form" method="POST" action="{{ url('preorder/buy/'.$preorder->preorder_id) }}">
                                {{ csrf_field() }}
                            <button type="submit" class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-credit-card"></i> Submit Payment</button>
                            </form>
                            <a class="btn btn-primary pull-right" href="{{url('preorder/inovice/'.$preorder->preorder_id)}}" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</a>
                        </div>
                    </div>
                </section><!-- /.content -->


            @section('notifications')
                @include('includes.notification')
            @stop

            @section('scripts')
                <script>
                    n =  new Date();
                    y = n.getFullYear();
                    m = n.getMonth() + 1;
                    d = n.getDate();
                    document.getElementById("date").innerHTML = m + "/" + d + "/" + y;
                </script>
                <script src="{{ URL::asset('js/preorder_script.js') }}"></script>
        @stop

        @endsection