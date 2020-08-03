<!DOCTYPE html>
<html> 
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>e-Recruitment System | @yield('title')</title>
        <link href="{{ url('assets/img/brand/favicon.png') }}" rel="icon" type="image/png"> 

        <!-- Icons -->
        <link href="{{ url('assets/vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
        <link href="{{ url('assets/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

        <!-- Argon CSS -->
        <link type="text/css" href="{{ url('assets/css/argon.min.css') }}" rel="stylesheet">
        <link type="text/css" href="{{ url('assets/css/style.css') }}" rel="stylesheet">
        <link type="text/css" href="{{ url('assets/vendor/sweetalert/sweetalert2.min.css') }}" rel="stylesheet"> 
        <link type="text/css" href="{{ url('assets/vendor/waitme/waitMe.min.css') }}" rel="stylesheet">

        @yield('header')
    </head>
    <body>
        @include('layouts.navigation')
        @yield('content')
 
        <!-- Core -->
        <script src="{{ url('assets/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ url('assets/vendor/popper/popper.min.js') }}"></script>
        <script src="{{ url('assets/vendor/bootstrap/bootstrap.min.js') }}"></script> 
        <script src="{{ url('assets/vendor/jquery/jquery-cookie.min.js') }}"></script>
        <script src="{{ url('assets/vendor/sweetalert/sweetalert2.min.js') }}"></script>
        <script src="{{ url('assets/vendor/handlebars/handlebars-v4.4.3.js') }}"></script>
        <script src="{{ url('assets/vendor/waitme/waitMe.min.js') }}"></script> 
        <!-- Theme JS -->
        <script src="{{ url('assets/js/argon.min.js') }}"></script> 
        <script src="{{ url('assets/js/main.js') }}"></script>  
        <script>
            const _config = {
                server_url: "{{ url('/') }}"
            };
        </script>
        @yield('footer')
    </body>
</html>