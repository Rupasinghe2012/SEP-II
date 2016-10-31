@include('includes.header')
<div id="wrapper">
    @include('includes.logout')
    @include('includes.sidebar')

            <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <section class="content-header">
                <ol class="breadcrumb">
                    @yield('breadcrumbs')
                </ol>
            </section>

            @yield('content')

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    @include('includes.footer')
</div>