<!doctype html>
<html class="no-js" lang="en">
@include('layouts.frontend.partials.head')

<body>
    <!-- header area start -->
    @include('layouts.frontend.partials.header')
    <!-- header area end -->

    @yield('content')

    <!-- scroll to top -->
    <div class="scroll-top not-visible">
        <i class="fa fa-angle-up"></i>
    </div> <!-- End Scroll to Top -->

    <!-- footer area start -->
    @include('layouts.frontend.partials.footer')
    <!-- footer area end -->

    <!-- all js include here -->
    @include('layouts.frontend.partials._script')
</body>

</html>