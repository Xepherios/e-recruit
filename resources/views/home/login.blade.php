@extends('layouts.template') 
@section('title', 'เข้าสู่ระบบ')
@section('header')
    <link type="text/css" href="{{ url('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"> 
@endsection
@section('content')
<section class="m-t-1em m-b-1em">
    <div class="container"> 
        <div class="row">
            <div class="col"></div>
            <div class="col-md-6 col-lg-6 col-sm-12p-l-15 p-r-15"><h5>เข้าสู่ระบบ</h5></div> 
            <div class="col"></div>
        </div>
        <div class="row">
            <div class="col"></div>
            <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="card"> 
                    <div class="card-body">
                        <form id = "login_form"> 
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <label for="form_email">อีเมล</label>
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="form_email" name="email" placeholder="name@example.com" autocomplete="off">
                                    </div>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <label for="form_password">รหัสผ่าน</label>
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="form_password" name="password" placeholder="" autocomplete="off">
                                    </div>
                                </div> 
                            </div> 
                            <div class="row"> 
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-success my-4">เข้าสู่ระบบ</button>
                                </div> 
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
</section>
@endsection
@section('footer') 
    <script src="{{ url('assets/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ url('assets/vendor/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ url('assets/js/login.js') }}"></script>
@endsection