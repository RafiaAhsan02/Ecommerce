<script src="{{ asset('assets/frontend/js/vendor/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/plugins.js') }}"></script>
<script src="{{ asset('assets/frontend/js/ajax-mail.js') }}"></script>
{{-- page related js --}}
@stack('page_js')
<script src="{{ asset('assets/frontend/js/main.js') }}"></script>

@stack('custom_js')