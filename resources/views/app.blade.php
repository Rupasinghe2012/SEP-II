@include('includes.header')
<div id="wrapper">
    @include('includes.logout')

    @include('includes.sidebar')
            <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                @yield('pageName')
            </h1>
            <ol class="breadcrumb">
                <li>@yield('breadcrumbs')</li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
            @yield('content')
            </div>
                </div>

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    @include('includes.footer')
</div>