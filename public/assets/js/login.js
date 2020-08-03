 
$(document).ready(function() { 
    $('#login_form').validate({
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
            password: {
                required: true,
                minlength: 6,
                maxlength: 20 
            }
        },
        messages: {
            email: {
                required: label.errors.required,
                email: label.errors.invalid_email_format
            },
            password: {
                required: label.errors.required,
                minlength: label.errors.min_password_required,
                maxlength: label.errors.max_password_required,
            }, 
        },
        highlight: function (input) {
            $(input).parents('.form-group').addClass('text-danger');
            $(input).parents('.input-group').parent().addClass('text-danger'); 
        },
        unhighlight: function (input) {
            $(input).parents('.form-group').removeClass('text-danger');
            $(input).parents('.input-group').parent().removeClass('text-danger'); 
        },
        submitHandler: function (form) {
            var data = {
                email: $("#form_email").val(), 
                password: $("#form_password").val()
            };
            callAPI(
                {
                    request_id: "login",
                    data: data,
                    url: "http://e-recruit.me/auth",
                    method: "POST"
                },
                function(json) {
                    if(json.error_code == 0 && typeof json.token != 'undefined' && json.token != null) {
                        Cookies.set('login_session_token', json.token, { expires: 7, path: '/' })
                        window.location = "http://e-recruit.me";
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