<!--   Core JS Files   -->
<script src="{{ asset('assets/backend/js/core/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/core/bootstrap.min.js') }}"></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset('assets/backend/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

<!-- Chart JS -->
<script src="{{ asset('assets/backend/js/plugin/chart.js/chart.min.js') }}"></script>

<!-- jQuery Sparkline -->
<script src="{{ asset('assets/backend/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Chart Circle -->
<script src="{{ asset('assets/backend/js/plugin/chart-circle/circles.min.js') }}"></script>

<!-- Datatables -->
<script src="{{ asset('assets/backend/js/plugin/datatables/datatables.min.js') }}"></script>

<!-- Bootstrap Notify -->
<script src="{{ asset('assets/backend/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

<!-- jQuery Vector Maps -->
<script src="{{ asset('assets/backend/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/plugin/jsvectormap/world.js') }}"></script>

<!-- Google Maps Plugin -->
<script src="{{ asset('assets/backend/js/plugin/gmaps/gmaps.js') }}"></script>

<!-- Sweet Alert -->
<script src="{{ asset('assets/backend/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

@stack('page_js')

<!-- Kaiadmin JS -->
<script src="{{ asset('assets/backend/js/kaiadmin.min.js') }}"></script>

@stack('custom_js')