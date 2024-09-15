<!DOCTYPE html>
<html lang="en">
<head>
    <meta content='width=device-width, initial-scale=1' name='viewport' />
    <meta content='IE=edge' http-equiv='X-UA-Compatible' />
    <title>my2wander - blogs</title>
    <meta content='text/html; charset=UTF-8' http-equiv='Content-Type' />
    <!-- Chrome, Firefox OS and Opera -->
    <meta content='#ffffff' name='theme-color' />
    <!-- Windows Phone -->
    <meta content='#ffffff' name='msapplication-navbutton-color' />
    <link href='favicon.ico' rel='icon' type='image/x-icon' />
    <link href='index.html' rel='canonical' />
    {{-- <link rel="alternate" type="application/atom+xml" title="eunoia. - Atom" href="feeds/posts/default" />
    <link rel="alternate" type="application/rss+xml" title="eunoia. - RSS" href="feeds/posts/default9522?alt=rss" /> --}}
    <!--Can't find substitution for tag [blog.ieCssRetrofitLinks]-->
    <meta content='my2wander.' property='og:title' />
    <meta content='' property='og:description' />
    <link href='https://fonts.googleapis.com/' rel='preconnect' />
    <link crossorigin='' href='https://fonts.gstatic.com/' rel='preconnect' />
    <link
        href='https://fonts.googleapis.com/css2?family=Gantari:wght@400;700&amp;family=Gentium+Plus:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap'
        rel='stylesheet' />
    <link crossorigin='anonymous' href='https://use.fontawesome.com/releases/v5.15.4/css/all.css' integrity='sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm' rel='stylesheet'/>
    <link href="{{ asset('client/css/page-skin.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('client/css/template-skin.css') }}" rel="stylesheet" type="text/css">

</head>

<body class='frontpage-view homepage-view' id="body">
    <div class='container-outer'>
        {{-- Header --}}
        @include('layout.header')
        <div class='main-container'>
            @yield('content')
        </div>
        {{-- Sidebar Outer --}}
        @include('layout.sidebar_outer')
        {{-- Footer --}}
        @include('layout.footer')
    </div>
    <script src="{{ asset('js/vendor.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ asset('client/js/responsive.js') }}"></script>
    @stack('js')
</body>
</html>
