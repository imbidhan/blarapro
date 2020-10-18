<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="probet admin template">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <link rel="apple-touch-icon" href="{{ asset('/images/apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('/images/favicon.ico') }}">

    <!-- Styles -->
    @yield('page_styles')

</head>

    <body class="animsition">

        <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please upgrade your browser to improve your experience.</p>
        <![endif]-->

        <!-- Start Header -->
        @include('backend.partials._header')
        <!-- Ends Header -->

        <!-- Start Sidebar -->
        @include('backend.partials._sidebar')
        <!-- Ends Sidebar -->

        <!-- Start maincontent -->
        @yield('page_content')
        <!-- Ends maincontent -->

        <!-- Start footer -->
        @include('backend.partials._footer')
        <!-- Ends footer -->

        <!-- Start Scripts -->
        @yield('page_scripts')
        <!-- Ends Scripts -->

    </body>

</html>
