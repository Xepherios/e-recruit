<!DOCTYPE html>
<html> 
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>e-Recruitment Admin System | @yield('title')</title>
        <link href="{{ url('assets/img/brand/favicon.png') }}" rel="icon" type="image/png"> 

        <!-- Icons -->
        <link href="{{ url('assets/vendor/nucleo/css/nucleo.css') }}" rel="stylesheet"> 
        <link href="{{ url('assets/vendor/font-awesome/css/all.min.css') }}" rel="stylesheet">
        <!-- CSS Files -->
        <link type="text/css" href="{{ url('assets/css/argon-dashboard.min.css') }}" rel="stylesheet" /> 
        <link type="text/css" href="{{ url('assets/vendor/sweetalert/sweetalert2.min.css') }}" rel="stylesheet"> 
        <link type="text/css" href="{{ url('assets/vendor/waitme/waitMe.min.css') }}" rel="stylesheet">
        <link type="text/css" href="{{ url('assets/css/admin.css') }}" rel="stylesheet" /> 
        @yield('header')
    </head>
    <body>
        @include('admin.navigation')
        @yield('content') 
        <!-- Core -->
        <script src="{{ url('assets/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ url('assets/vendor/popper/popper.min.js') }}"></script>
        <script src="{{ url('assets/vendor/bootstrap/bootstrap.min.js') }}"></script> 
        <script src="{{ url('assets/vendor/jquery/jquery-cookie.min.js') }}"></script>
        <script src="{{ url('assets/vendor/sweetalert/sweetalert2.min.js') }}"></script> 
        <script src="{{ url('assets/vendor/waitme/waitMe.min.js') }}"></script> 
        <script src="{{ url('assets/vendor/font-awesome/js/all.min.js') }}"></script> 

        <!-- Theme JS -->
        <script src="{{ url('assets/js/argon.min.js') }}"></script> 
        <script src="{{ url('assets/vendor/chart.js/dist/Chart.min.js') }}"></script>
        <script src="{{ url('assets/vendor/chart.js/dist/Chart.extension.js') }}"></script>
         
        <!--   Argon JS   -->
        <script src="{{ url('assets/js/argon-dashboard.min.js') }}"></script> 
        <script>
            const _config = {
                server_url: "{{ url('/') }}"
            };
            const _label = {
                errors: {
                    required: "กรุณาระบุข้อมูลนี้",
                    password_do_not_match: "รหัสผ่านไม่ตรงกัน",
                    min_password_required:  "รหัสผ่านต้องมีอย่างน้อย 6 ตัวอักษร",
                    max_password_required:  "รหัสผ่านต้องไม่เกิน 20 ตัวอักษร",
                    invalid_email_format: "รูปแบบอีเมลไม่ถูกต้อง",
                    required_digits: "กรุณากรอกตัวเลขเท่านั้น"
                }
            };
        </script>
        @yield('footer')
    </body>
</html>