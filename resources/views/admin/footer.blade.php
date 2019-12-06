    <!-- ./wrapper -->

   
    <!-- Bootstrap 4 -->
    <script src="{{ URL::asset('/assets/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('/assets/admin-lte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/admin-lte/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
   
    <!-- AdminLTE App -->
    <script src="{{ URL::asset ('/assets/admin-lte/dist/js/adminlte.min.js') }}" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ URL::asset ('/assets/admin-lte/dist/js/demo.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ URL::asset('/assets/admin-lte/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script type="text/javascript"  >
    $(function () {
        // Summernote
       // $('.editor').summernote();

        $('.select2').select2();
    })
    </script>
</body>
</html>