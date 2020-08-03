@extends('layouts.template') 
@section('title', 'ลงทะเบียน')
@section('header')
     
@endsection
@section('content')
<section class="m-t-1em m-b-1em">
    <div class="container"> 
        <div class="row">
            <div class="p-l-15 p-r-15"><h5>สร้างโปรไฟล์สำหรับการสมัครงาน</h5></div> 
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="card"> 
                    <div class="card-body">
                        <form id = "register_form"> 
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="form_email">อีเมล <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="form_email" name="email" placeholder="name@example.com" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="form_identification_number">เลขประจำตัวประชาชน <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="form_identification_number" name="identification_number" placeholder="1-2345-67890-12-3" autocomplete="off" size="17">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="form_password">รหัสผ่าน <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="form_password" name="password" placeholder="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="form_password">รหัสผ่าน (อีกครั้ง) <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="form_password_again" name="password_again" placeholder="" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="form_firstname">ชื่อ <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="form_firstname" name="first_name" placeholder="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="form_lastname">นามสกุล <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="form_lastname" name="last_name" placeholder="" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="form_phone_number">เบอร์โทรศัพท์ <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="form_phone_number" name="phone_number" placeholder="" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="form_date_of_birth">วันเกิด <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="form_date_of_birth" name="date_of_birth" autocomplete="off">
                                    </div>
                                </div>
                                
                            </div> 
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <label for="form_gender">เพศ <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <select class="form-control" id="form_gender" name="gender"> 
                                            <option value="M">ชาย</option>
                                            <option value="F">หญิง</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label for="form_military_status">สถานะการเกณฑ์ทหาร <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <select class="form-control" id="form_military_status" name="military_status"> 
                                            <option value="exempt">ได้รับการยกเว้น</option>
                                            <option value="military_studied">ศึกษาวิชาทหาร</option>
                                            <option value="discharge">ผ่านการเกณฑ์ทหาร</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-md-3 col-sm-12">
                                    <label for="form_military_status">เชื้อชาติ <span class="text-danger">*</span></label> 
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="form_nationality" name="nationality" placeholder="" autocomplete="off" >
                                    </div>
                                </div>  
                                <div class="col-md-3 col-sm-12">
                                    <label for="form_military_status">สัญชาติ <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="form_race" name="race" placeholder="" autocomplete="off">
                                    </div>
                                </div>   
                            </div> 
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="form_address">ที่อยู่</label>
                                    <textarea class="form-control" id="form_address" name = "address" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-md-12 text-center">
                                    <button id = "register_btn" type="submit" class="btn btn-default my-4">ลงทะเบียน</button>
                                    <input type="reset" class="btn btn-danger my-4" value="รีเซ็ต">
                                </div> 
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('footer')
    <script src="{{ url('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ url('assets/vendor/bootstrap-datepicker/locales/bootstrap-datepicker.th.min.js') }}"></script>
    <script src="{{ url('assets/vendor/mask/jquery.mask.min.js') }}"></script>
    <script src="{{ url('assets/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ url('assets/vendor/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ url('assets/js/register.js') }}"></script>
@endsection