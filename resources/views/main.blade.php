@include('layouts.header')

@include('layouts.sidebar')


<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    @include('layouts.content')


    @include('layouts.footer')

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('temp') }}/vendor/jquery/jquery.min.js"></script>
<script src="{{ asset('temp') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('temp') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('temp') }}/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="{{ asset('temp') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('temp') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('temp') }}/js/demo/datatables-demo.js"></script>

<!-- Page level plugins -->
<script src="{{ asset('temp') }}/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('temp') }}/js/demo/chart-area-demo.js"></script>
<script src="{{ asset('temp') }}/js/demo/chart-pie-demo.js"></script>

</body>

</html>
