<footer>
<!-- jQuery 2.1.4 -->
<script src="/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/js/demo.js"></script>

    <script src="{{ asset('/js/parsley.min.js')}}"></script>
    <script src="{{ asset('/dist/sweetalert.min.js')}}"></script>

    <script src="{{ asset('/js/alert.js')}}"></script>

    <script src="{{ asset('/js/notification.js')}}"></script>

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


    </script>



    @yield('scripts')
</footer>
</body>
</html>
