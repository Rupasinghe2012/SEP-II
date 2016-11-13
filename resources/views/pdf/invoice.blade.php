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
            <img src="{{ public_path().'/img/credit/visa.png'}}" alt="Visa">
            <img src="{{public_path().'/img/credit/mastercard.png'}}" alt="Mastercard">
            <img src="{{public_path().'/img/credit/american-express.png'}}" alt="American Express">
            <img src="{{public_path().'/img/credit/paypal2.png'}}" alt="Paypal">
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


</section><!-- /.content -->