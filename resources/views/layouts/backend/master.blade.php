<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.backend.partials.head')
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('layouts.backend.partials.sidebar')
        <!-- End Sidebar -->

        <div class="main-panel">
            {{-- header --}}
            @include('layouts.backend.partials.header')

            <div class="container">
                <div class="page-inner">
                    @yield('content')
                </div>
            </div>

            {{-- footer --}}
            @include('layouts.backend.partials.footer')
        </div>
    </div>
    @include('layouts.backend.partials._script')
</body>

</html>