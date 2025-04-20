<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Admin Dashboard</title>
<meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
<link rel="icon" href="{{ asset('assets/backend/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />

<!-- Fonts and icons -->
<script src="{{ asset('assets/backend/js/plugin/webfont/webfont.min.js') }}"></script>
<script>
    WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
            families: [
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ["{{ asset('assets/backend/css/fonts.min.css') }}"],
        },
        active: function () {
            sessionStorage.fonts = true;
        },
    });
</script>

@stack('page_css')
<!-- CSS Files -->
<link rel="stylesheet" href="{{ asset('assets/backend/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/backend/css/plugins.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/backend/css/kaiadmin.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/backend/custom.css') }}" />
