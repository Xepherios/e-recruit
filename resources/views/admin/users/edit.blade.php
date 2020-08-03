@extends('admin.template')
@section('title', 'e-Recruitment Admin')
@section('header')
   
@endsection
@section('content')
<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="container-fluid mt-2">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">แก้ไขผู้ดูแลระบบ</h3>
                            </div> 
                        </div>
                    </div>
                    <div id ="user_list_card" class="card-body">
                        @if ($errors)
                            <div class="alert alert-warning alert-dismissible fade show" role="alert"> 
                                <span class="alert-inner--text">{{$errors}}</span> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif 
                        <div class="row">
                            <div class="col-md-6 center">
                                
                                <form role="form" id="form_edit_admin" method="POST" action="{{url("/admin/users/edit/{$user_data['id']}")}}">
                                    <div class="form-group mb-3">
                                        <label>ชื่อผู้ใช้งาน</label><br />
                                        <span class="text-muted">{{$user_data['username']}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label>รหัสผ่าน</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="รหัสผ่าน" name = "password" type="password">
                                        </div>
                                    </div>  
                                    <div class="col-4 p-0">
                                        <label>สถานะ</label>
                                        <div class="input-group input-group-alternative">
                                            <select class="form-control" name="status"> 
                                                <option value="active" @if($user_data['status'] == 'active') selected @endif>ใช้งาน</option>
                                                <option value="inactive" @if($user_data['status'] == 'inactive') selected @endif>ไม่ใช้งาน</option> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary my-4">บันทึก</button>
                                    </div>
                                </form>
                            </div> 
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@section('footer')
<script src="{{ url('assets/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ url('assets/vendor/jquery-validation/additional-methods.min.js') }}"></script>
<script>
    var validator;
    if( typeof validator != 'undefined' && validator != null ) {
        validator.destroy();
    }
    validator = $('#form_add_admin').validate({
        focus: function () {
            $(this).closest('form').validate().settings.onkeyup = false;
        },
        blur: function (input) {
            $(this).closest('form').validate().settings.onkeyup = $.validator.defaults.onkeyup;
        },
        rules: {
            username: {
                required: true
            },
            password: {
                minlength: 6,
                maxlength: 20
            }  
        },
        messages: {
            username: {
                required: _label.errors.required,
            },
            password: {
                required: _label.errors.required,
                minlength: _label.errors.min_password_required,
                maxlength: _label.errors.max_password_required,
            },
        },
        highlight: function (input) {
            
        },
        unhighlight: function (input) {
            
        },
        submitHandler: function (form) {
            $(form).submit(); 
        },
        errorPlacement: function (error, element) {
            $(element).closest('.input-group').parent().append(error);
            $(element).parents('.form-group').append(error);
        }
    });
    </script>
     
@endsection
