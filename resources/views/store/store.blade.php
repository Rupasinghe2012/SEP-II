@extends ('app')

@section('content')

@section('pageName')
  Profiler.Net Store
@stop
{{--breadcrumb--}}
@section('breadcrumbs')
    {!! Breadcrumbs::render('store') !!}
@stop
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#"><b><div  id="categoryName">{{ $category }}</div></b></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories<span class="caret"></span></a>
                        <ul class="dropdown-menu">

                            {{--@foreach ($list as $category)--}}
                                {{--<li><a onClick="changeCategory('{{ $category->name }}')">{{ $category->name }}</a></li>--}}
                            {{--@endforeach--}}

                            <li><a onClick="changeCategory('All')">All</a></li>
                        </ul>
                    </li>
                </ul>
                </ul>
                <form class="navbar-form navbar-left" role="search" id="searchForm">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Enter item name" id="searchField" data-toggle="tooltip">
                    </div>
                    <button type="button" class="btn btn-default" onclick="searchItem();">Search</button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li class="ajax-loader"> </li>
                    <li><a href="#" id="checkout" data-target="#checkoutModal" data-toggle="modal"><span id="itemCount" class="badge">{{ $orderitems }}</span> Checkout</a></li>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div id="messages">
                @if (Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                @if (Session::has('error-message'))
                    <div class="alert alert-danger">{{ Session::get('error-message') }}</div>
                @endif
            </div>
            <div id="searchResults"></div>
        </div>
    </div>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="ModalHeading">Add item</h4>
                </div>
                <div class="modal-body">
                    <div class="ajax-loader"></div>
                    <div class="row">
                        <div class="col-lg-6">
                            <form class="form-horizontal">
                                <div class="form-group" id="qtyGroup">
                                    <label for="quantity" class="control-label col-sm-3">Quantity:</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="qtyField">
                                    </div>
                                    <label id="lblQtyError" class="control-label hidden" for="qtyField">Enter valid quantity</label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Unit Cost:</label>
                                    <div class="col-sm-3">
                                        <p class="form-control-static" id="unitCost">0.00</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Total Cost:</label>
                                    <div class="col-sm-3">
                                        <h1 id="totalCost">0.00</h1>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6">
                            <div class="thumbnail">
                                <img id="productImg" onerror="if (this.src != '/images/img_placeholder.png') this.src = '/images/img_placeholder.png';">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btnCloseModal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnAddItem">Add item</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="ModalHeading">Checkout</h4>
                </div>
                <div class="modal-body">
                    <div class="ajax-loader"></div>
                    <div class="row">
                        <table id="sessionItemsTable" class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th id="headeritm_name" class="col-lg-2">Item</th>
                                <th id="headerqty" class="col-lg-1"> Quantity</th>
                                <th id="headeruvalue" class="col-lg-1">Unit Value</th>
                                <th id="headerltotal" class="col-lg-2">Total</th>
                            </tr>
                            </thead>

                    </div>
                    <tbody id="checkoutBody">
                    <!--Filled by javascript-->
                    </tbody>
                    </table>
                    <div class="col-lg-1"> </div>
                    <div class="col-lg-10">
                        <div class="form-group">
                            <label for="comment" class="label label-info">Remarks:</label>
                            <textarea class="form-control" rows="2" id="description" style="background-color:#F3F3F4;">No Remarks.</textarea>
                        </div>
                    </div>
                    <div class="col-lg-1"> </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" id="btnClear">Clear</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btnCloseModal">Close</button>
                    <button type="button" class="btn btn-success" id="btnCheckout">Checkout</button>
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