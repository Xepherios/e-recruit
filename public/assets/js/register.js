var dob_picker;
$(document).ready(function() {
    $('#form_identification_number').mask('0-0000-00000-00-0'); 
    dob_picker = $('#form_date_of_birth').datepicker({
        format: 'dd/mm/yyyy', 
        endDate: '-1d',
        language: 'th'
    }); 
    $.validator.addMethod("checkIdentityNumber", function(value, element) {
        let id =  value.replace(/-/g, ''); 
 
        if (id.length != 13) return false;

        for (i=0, sum=0; i < 12; i++) {
            sum += parseFloat(id.charAt(i))*(13-i);
        }
        if ( (11 - sum % 11) % 10 != parseFloat(id.charAt(12)) )  { 
            return false;
        } else { 
            return true;
        }  
    }, "เลขประจำตัวประชาชนไม่ถูกต้อง");
    $('#register_form').validate({
        focus: function () {
            $(this).closest('form').validate().settings.onkeyup = false;
        },
        blur: function (input) {
            $(this).closest('form').validate().settings.onkeyup = $.validator.defaults.onkeyup;
        },
        rules: {
            email: {
                required: true,
                email: true
            },
            identification_number: {
                required: true,
                checkIdentityNumber: true
            },
            password: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            password_again: {
                required: true,
                minlength: 6,
                maxlength: 20,
                equalTo: "#form_password"
            },
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            phone_number: {
                required: true
            },
            date_of_birth: {
                required: true
            },
            race: {
                required: true
            },
            nationality: {
                required: true
            },
        },
        messages: {
            email: {
                required: label.errors.required,
                email: label.errors.invalid_email_format
            },
            identification_number: {
                required: label.errors.required
            },
            first_name: {
                required: label.errors.required
            },
            last_name: {
                required: label.errors.required
            },
            phone_number: {
                required: label.errors.required
            },
            date_of_birth: {
                required: label.errors.required
            },
            race: {
                required: label.errors.required
            },
            nationality: {
                required: label.errors.required
            },
            password: {
                required: label.errors.required,
                minlength: label.errors.min_password_required,
                maxlength: label.errors.max_password_required,
            }, 
            password_again: {
                required: label.errors.required,
                minlength: label.errors.min_password_required,
                maxlength: label.errors.max_password_required,
                equalTo: label.errors.password_do_not_match
            } 
        },
        highlight: function (input) {
             
        },
        unhighlight: function (input) {
             
        },
        submitHandler: function (form) {
            var data = {
                email: $("#form_email").val(),
                identification_number: $("#form_identification_number").val(),
                password: $("#form_password").val(),
                password_again: $("#form_password_again").val(),
                first_name: $("#form_firstname").val(),
                last_name: $("#form_lastname").val(),
                phone_number: $("#form_phone_number").val(),
                date_of_birth: $("#form_date_of_birth").val(),
                gender: $("#form_gender").val(),
                military_status: $("#form_military_status").val(),
                address: $("#form_address").val(),
                race: $("#form_race").val(),
                nationality: $("#form_nationality").val(),
            }; 
            callAPI(
                {
                    request_id: "register",
                    data: data,
                    url: "http://e-recruit.me/register",
                    method: "POST"
                },
                function(json) { 
                    if(json.error_code == 0) {
                        customSwal.fire({ 
                            type: 'success',
                            title: 'ลงทะเบียนเรียบร้อยแล้ว',
                            text: 'โปรดยืนยันอีเมลเพื่อเข้าใช้งาน',
                        }).then((result) => {
                            if (result.value) {
                               window.location = "http://e-recruit.me/login"
                            }
                        })
                    }
                }
            );
            return false;
        },
        errorPlacement: function (error, element) {
            $(element).closest('.input-group').parent().append(error);
            $(element).parents('.form-group').append(error);
        }
    });
});