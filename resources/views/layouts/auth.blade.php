<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>@yield('title') | {{ env('APP_NAME') }}</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- Start css -->
    <link href="{{ asset_admin('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset_admin('css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset_admin('css/style.css?ver=5') }}" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="description" content="Vinaguild -  Admin Panel HTML Dashboard Template">
    <meta name="author" content="Vinaguild Technologies Private Limited">
    <meta name="keywords" content="admin,dashboard,panel,bootstrap admin template,bootstrap dashboard,dashboard,themeforest admin dashboard,themeforest admin,themeforest dashboard,themeforest admin panel,themeforest admin template,themeforest admin dashboard,cool admin,it dashboard,admin design,dash templates,saas dashboard,dmin ui design">

    <!-- Favicon -->
    <link rel="icon" href="../../assets/img/brand/favicon.ico" type="image/x-icon"/>

    <!-- Title -->
    <title>@yield('title') | {{ env('APP_NAME') }}</title>

    <!-- Bootstrap css-->
    <link href="{{ asset_admin('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"/>

    <!-- Icons css-->
    <link href="{{ asset_admin('plugins/web-fonts/icons.css') }}" rel="stylesheet"/>
    <link href="{{ asset_admin('plugins/web-fonts/font-awesome/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset_admin('plugins/web-fonts/plugin.css') }}" rel="stylesheet"/>

    <!-- Style css-->
    <link href="{{ asset_admin('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset_admin('css/skins.css') }}" rel="stylesheet">
    <link href="{{ asset_admin('css/dark-style.css') }}" rel="stylesheet">
    <link href="{{ asset_admin('css/colors/default.css') }}" rel="stylesheet">

    <!-- Color css-->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ asset_admin('css/colors/color.css') }}">
    @yield('stylesheet')
    <!-- End css -->
</head>

<body class="main-body leftmenu">
    {!! view('vendor.loader') !!}
    <!-- Page -->
    <div class="page main-signin-wrapper">
        <!-- Row -->
        <div class="row signpages text-center">
            <div class="col-md-12">
                @yield('content')
            </div>
        </div>
        <!-- End Row -->

    </div>
    <!-- End Page -->

    <!-- Jquery js-->
    <script src="{{ asset_admin('/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset_admin('plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset_admin('plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Select2 js-->
    <script src="{{ asset_admin('plugins/select2/js/select2.min.js') }}"></script>

    <!-- Custom js -->
    <script src="{{ asset_admin('js/custom.js') }}"></script>

    @foreach($jsFiles as $js)
        <script src="{{ asset_admin($js) }}"></script>
    @endforeach

    @if(session('notice_success'))
        <script type="text/javascript">
            toastr.success("{{ session('notice_success') }}");
        </script>
    @endif

    @yield('scripts')
</body>

</html>