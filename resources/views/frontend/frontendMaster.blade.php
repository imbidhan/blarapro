<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('/images/favicon.jpg') }}"/>
    <title>Onbet365</title>

    @include('frontend.partials.styleFiles')

</head>
    <body>

    <!-- Menu -->
    @yield("mainMenu")
    <!-- Menu -->

    <!-- Main Content -->
    @yield('content')
    <!-- Main Content -->

    <!-- footer top and bottom -->
    @yield("main-footer")
    <!-- footer top and bottom -->

    <!-- Script -->
    @yield("main-script")

    @yield("scriptExtra")
    <!-- Script -->
    </body>
</html>
