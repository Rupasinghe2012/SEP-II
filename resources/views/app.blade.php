@include('includes.header')
<div id="wrapper">
    @include('includes.logout')
    @include('includes.sidebar')

            <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">

            @yield('content')

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    @include('includes.footer')
</div>