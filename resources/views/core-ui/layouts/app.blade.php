<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v2.1.11
* @link https://coreui.io
* Copyright (c) 2018 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)

*
* PT KRAKATAU INFORMATION TECHNOLOGY
* kUROB
* JCP@2019
*
-->

<html lang="en">

<head>
    <base href="{{ asset('./') }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>RAKORDIR PT KRAKATAU-IT</title>
    <!-- Icons-->
    <link href="{{ asset('vendors/@coreui/icons/css/coreui-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">
    <style>
        .select2 {
            width:100%!important;
        }
    </style>
    @stack('style')

    <!-- Main styles for this application-->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/pace-progress/css/pace.min.css') }}" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics-->
    {{--
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script> --}}
    <script>
        window.dataLayer = window.dataLayer || [];

        // function gtag() {
        //     dataLayer.push(arguments);
        // }
        // gtag('js', new Date());
        // // Shared ID
        // gtag('config', 'UA-118965717-3');
        // // Bootstrap ID
        // gtag('config', 'UA-118965717-5');
    </script>
</head>
@stack('login')
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    
    {{-- navigasi bar --}}
    @stack('navbar')
    {{-- navigasi bar --}}

    <div class="app-body">
        {{-- MENU SEBELAH KIRI --}}
        @stack('menukiri')
        {{-- AKHIR MENU SEBELAH KIRI --}}

        {{-- KONTEN --}}
        <main class="main">
            @yield('content')
        </main>
        {{-- AKHIR KONTEN --}}

        {{-- MENU SEBELAH KANAN --}}
        @stack('menukanan')
        {{-- AKHIR MENU SEBELAH KANAN --}}
    </div>

    @stack('footer')
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('vendors/jquery/js/jquery.min.js') }}"></script>
    <script src="{{ asset('vendors/popper.js/js/popper.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/pace-progress/js/pace.min.js') }}"></script>
    <script src="{{ asset('vendors/perfect-scrollbar/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('vendors/@coreui/coreui/js/coreui.min.js') }}"></script>
    <!-- Plugins and scripts required by this view-->
    <!-- script dari view -->
    
    <script>
        function url() {
            var baseUrl = "{{ url('') }}/";
            return baseUrl;
        }
    </script>
    @stack('script')
    <!-- script dari view -->
</body>

</html>