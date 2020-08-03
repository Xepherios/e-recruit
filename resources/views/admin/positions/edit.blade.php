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
                                <h3 class="mb-0">แก้ไขตำแหน่งงาน</h3>
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
                                
                                <form role="form" id="form_edit_position" method="POST" action="{{url("/admin/positions/edit/{$positions->id}")}}">
                                    <div class="form-group mb-3">
                                        <label>ชื่อตำแหน่ง</label>
                                        <div class="input-group input-group-alternative"> 
                                            <input class="form-control" placeholder="" name = "name" type="text" value="{{$positions->job_name}}">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>แผนก</label>
                                        <div class="input-group input-group-alternative">
                                            <select class="form-control" name="department"> 
                                                @foreach ($departments as $department)
                                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>หน้าที่และความรับผิดชอบ</label>
                                        <div class="input-group input-group-alternative">
                                        <textarea class="form-control form-control-alternative" rows="3" name="description">{{$positions->job_description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>คุณสมบัติผู้สมัคร</label>
                                        <textarea class="form-control form-control-alternative" rows="3" name="qualification">{{$positions->job_qualification}}</textarea>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label>เงินเดือนขั้นต่ำ</label>
                                        <div class="input-group input-group-alternative"> 
                                            <input class="form-control" placeholder="" name = "min_salary" type="text" value="{{$positions->min_salary}}">
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>เงินเดือนสูงสุด</label>
                                        <div class="input-group input-group-alternative"> 
                                            <input class="form-control" placeholder="" name = "max_salary" type="text" value="{{$positions->max_salary}}">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary my-4">เพิ่ม</button>
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
    var position_validator;
    if( typeof position_validator != 'undefined' && position_validator != null ) {
        position_validator.destroy();
    }
    position_validator = $('#form_edit_position').validate({
        focus: function () {
            $(this).closest('form').validate().settings.onkeyup = false;
        },
        blur: function (input) {
            $(this).closest('form').validate().settings.onkeyup = $.validator.defaults.onkeyup;
        },
        rules: { 
            name: {
                required: true
            },
            department: {
                required: true
            },
            description: {
                required: true
            },
            qualification: {
                required: true
            },
            min_salary: {
                required: true,
                digits: true
            },
            max_salary: {
                required: true,
                digits: true
            },
        },
        messages: {
            name: {
                required: _label.errors.required
            },
            department: {
                required: _label.errors.required
            },
            description: {
                required: _label.errors.required
            },
            qualification: {
                required: _label.errors.required
            },
            min_salary: {
                required: _label.errors.required,
                digits: _label.errors.required_digits
            },
            max_salary: {
                required: _label.errors.required,
                digits: _label.errors.required_digits
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
