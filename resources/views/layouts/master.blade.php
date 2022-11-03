<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Vinaguild -  Admin Panel HTML Dashboard Template">
    <meta name="author" content="Vinaguild Technologies Private Limited">
    <meta name="keywords"
          content="admin,dashboard,panel,bootstrap admin template,bootstrap dashboard,dashboard,themeforest admin dashboard,themeforest admin,themeforest dashboard,themeforest admin panel,themeforest admin template,themeforest admin dashboard,cool admin,it dashboard,admin design,dash templates,saas dashboard,dmin ui design">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset_admin('img/brand/favicon.ico') }}" type="image/x-icon"/>

    @foreach($cssFiles as $css)
        <link rel="stylesheet" href="{{ asset_admin($css) . '?ver=4' }}">
    @endforeach

<!-- Title -->
    <title>@yield('title') | {{ env('APP_NAME') }}</title>
    @yield('stylesheet')
</head>
<body class="main-body leftmenu">
{{-- {!! view('vendor.loader') !!} --}}
<div class="page">
    <!-- Start Leftbar -->
    <div class="main-sidebar main-sidebar-sticky side-menu">
        {!! view('vendor.sidebar.logo') !!}
        {!! view('vendor.sidebar.index', ['menu_active' => isset($menu_active) ? $menu_active : '']) !!}
    </div>

    {!! view('vendor.header') !!}
    <div class="main-content side-content pt-0">
        <div class="container-fluid">
            <div class="inner-body">
                <div class="page-header">
                    <div>
                        @yield('breadcrumb')
                    </div>
                    <div class="d-flex">
                        <div class="justify-content-center">
                            @yield('header_button')
                        </div>
                    </div>
                </div>
                @yield('content')
            </div>
        </div>
    </div>
    <!-- End Rightbar -->
</div>

<div aria-hidden="false" role="dialog" aria-labelledby="exampleModalLongTitle" class="modal fade in bd-example-modal-lg"
     id="detailModal" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="finishModalLabel" class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div id='modal_content' class="modal-body"></div>
        </div>
    </div>
</div>

@foreach($jsFiles as $js)
    <script src="{{ asset_admin($js) }}"></script>
@endforeach

@if(session('notice_success'))
    <script type="text/javascript">
        toastr.success("{{ session('notice_success') }}");
    </script>
@endif

@if(session('notice_error'))
    <script type="text/javascript">
        toastr.error("{{ session('notice_error') }}");
    </script>
@endif
@yield('scripts')
</body>
</html>