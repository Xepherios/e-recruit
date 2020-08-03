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
                                <h3 class="mb-0">เพิ่มแผนกใหม่</h3>
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
                            <div class="col-6 center">
                                
                                <form role="form" id="form_add_department" method="POST" action="{{url('/admin/departments/add')}}">
                                    <div class="form-group mb-3">
                                        <label>ชื่อแผนก</label>
                                        <div class="input-group input-group-alternative"> 
                                            <input class="form-control" placeholder="ชื่อแผนก" name = "department_name" type="text">
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
    var validator;
    if( typeof validator != 'undefined' && validator != null ) {
        validator.destroy();
    }
    validator = $('#form_add_department').validate({
        focus: function () {
            $(this).closest('form').validate().settings.onkeyup = false;
        },
        blur: function (input) {
            $(this).closest('form').validate().settings.onkeyup = $.validator.defaults.onkeyup;
        },
        rules: { 
            department_name: {
                required: true
            } 
        },
        messages: {
            department_name: {
                required: _label.errors.required
            } 
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
