<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>e-Recruitment Admin System | Login</title>
    <link href="{{ url('assets/img/brand/favicon.png') }}" rel="icon" type="image/png">

    <!-- Icons -->
    <link href="{{ url('assets/vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
    <link href="{{ url('assets/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Argon CSS -->
    <!-- CSS Files -->
    <link type="text/css" href="{{ url('assets/css/argon-dashboard.min.css') }}" rel="stylesheet" />
    <link type="text/css" href="{{ url('assets/vendor/sweetalert/sweetalert2.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ url('assets/vendor/waitme/waitMe.min.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0"> 
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <small><b>โปรดเข้าสู่ระบบ</b></small>
                        </div>
                        <form role="form" method="POST" action="{{url('admin/login')}}">
                            @if ($errors)
                                <div class="alert alert-warning alert-dismissible fade show" role="alert"> 
                                    <span class="alert-inner--text">{{$errors}}</span> 
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="form-group mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="ชื่อผู้ใช้งาน" type="text" name="username" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="รหัสผ่าน" type="password" name="password">
                                </div>
                            </div> 
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">เข้าสู่ระบบ</button>
                            </div>
                        </form>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <!-- Core -->
    <script src="{{ url('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('assets/vendor/popper/popper.min.js') }}"></script>
    <script src="{{ url('assets/vendor/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/vendor/jquery/jquery-cookie.min.js') }}"></script>
    <script src="{{ url('assets/vendor/sweetalert/sweetalert2.min.js') }}"></script>
    <script src="{{ url('assets/vendor/handlebars/handlebars-v4.4.3.js') }}"></script>
    <script src="{{ url('assets/vendor/waitme/waitMe.min.js') }}"></script>

    <!--   Argon JS   -->
    <script src="{{ url('assets/js/argon-dashboard.min.js') }}"></script>
    
    <script>
        const _config = {
            server_url: "{{ url('/') }}"
        }; 
    </script>
    @yield('footer') 
</body>

</html>
