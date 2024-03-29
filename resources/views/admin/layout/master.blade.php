<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $title ?? ''}} - {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- Summernote css -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <!-- App css -->
    <link href="{{ asset('css/app-creative.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" id="light-style">
    <link href="{{ asset('css/app-creative-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body class=""
    data-layout-config="{&quot;leftSideBarTheme&quot;:&quot;dark&quot;,&quot;layoutBoxed&quot;:false, &quot;leftSidebarCondensed&quot;:false, &quot;leftSidebarScrollable&quot;:false,&quot;darkMode&quot;:false, &quot;showRightSidebarOnStart&quot;: true}"
    data-leftbar-theme="dark">
    <!-- Begin page -->
    <div class="wrapper mm-active" style="">
        <!-- ========== Left Sidebar Start ========== -->
        @include('admin.layout.sidebar')
        <!-- Left Sidebar End -->

        <!-- Start Page Content here -->
        <div class="content-page">
            {{-- Toats --}}
            @include('admin.components.toast')
            <div class="content">
                <!-- Topbar Start -->
                @include('admin.layout.topbar')
                <!-- end Topbar -->

                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">{{ $title ?? ''}}</h4>
                            </div>
                        </div>
                    </div>
                    @yield('content')
                </div>
                <!-- container -->
            </div>
            <!-- content -->

            <!-- Footer Start -->
            @include('admin.layout.footer')
            <!-- end Footer -->

        </div>
    </div>
    <!-- END wrapper -->

    <!-- bundle -->
    <script src="{{ asset('js/vendor.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ asset('js/common.js') }}"></script>
    @stack('js')
</body>

</html>
