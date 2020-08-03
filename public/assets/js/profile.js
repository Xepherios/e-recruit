var dob_picker;
var current_page = 1;
var validation;
var work_experience_block = 0;
var education_block = 0;
var exp_validator;
var pro_validator;
var edu_validator;

$(document).ready(function() { 
    // Change Password Form    
    $('#change_password_form').validate({
        focus: function () {
            $(this).closest('form').validate().settings.onkeyup = false;
        },
        blur: function (input) {
            $(this).closest('form').validate().settings.onkeyup = $.validator.defaults.onkeyup;
        },
        rules: {
            old_password: {
                required: true,
                minlength: 6,
                maxlength: 20
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
            } 
        },
        messages: {
            old_password: {
                required: label.errors.required,
                minlength: label.errors.min_password_required,
                maxlength: label.errors.max_password_required,
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
                old_password: $("#form_old_password").val(),
                password: $("#form_password").val(),
                password_again: $("#form_password_again").val(), 
            };
            callAPI(
                {
                    request_id: "change_password",
                    data: data,
                    url: _config.server_url + "/password",
                    method: "PATCH"
                },
                function(json) {
                    if( json.error_code == 0 ) {
                        Swal.fire({ 
                            type: 'success',
                            title: 'เปลี่ยนรหัสผ่านเรียบร้อย', 
                        });
                        $("#change_password_form")[0].reset();
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
    
    setHelper();
    $("#tabs_application").on('show.bs.tab', function() { 
        getApplications(); 
    }) ;
    
    getCandidateProfile();
    getCandidateWorkExperiences(); 
    getCandidateEducation();
});
 
function getCandidateProfile() { 
    showWaitMe($("#candidate_profile_form"), "โปรดรอสักครู่");
    callAPI(
        {
            request_id: "candidate_profile", 
            url: _config.server_url + "/candidate",
            method: "GET"
        },
        function(json) {
            if(json.error_code == 0) {
                if( typeof json.candidate != 'undefined') {
                    var obj_data = {
                        candidate_data: json.candidate 
                    };

                    var select_source = $("#candidate_profile_detail_template").html();
                    var select_template = Handlebars.compile(select_source);
                    var html = select_template(obj_data);
                    var place = $("#profile_form_detail");
                    renderHandlebarTemplateHtml(place, html, 'clear-append');  
                    
                    var select_source = $("#candidate_profile_form_template").html();
                    var select_template = Handlebars.compile(select_source);
                    var html = select_template(obj_data);
                    var place = $("#profile_form_edit_detail");
                    renderHandlebarTemplateHtml(place, html, 'clear-append'); 

                    bindProfileTemplate(); 
                } 
            } 
            hideWaitMe($("#candidate_profile_form"));
        }
    );
}
 
function getCandidateWorkExperiences() { 
    showWaitMe($("#work_experiences_form"), "โปรดรอสักครู่");
    callAPI(
        {
            request_id: "candidate_experiences", 
            url: _config.server_url + "/candidate-experiences",
            method: "GET"
        },
        function(json) {
            if(json.error_code == 0) {
                if( typeof json.candidate_experiences != 'undefined') {
                    
                    var obj_data = { 
                        candidate_experiences: json.candidate_experiences,
                    };  
                    var select_source = $("#work_experiences_detail_template").html();
                    var select_template = Handlebars.compile(select_source);
                    var html = select_template(obj_data);
                    var place = $("#work_experiences_detail");
                    renderHandlebarTemplateHtml(place, html, 'clear-append'); 

                    var select_source = $("#work_experiences_form_template").html();
                    var select_template = Handlebars.compile(select_source);
                    var html = select_template(obj_data);
                    var place = $("#work_experiences_edit_detail_zone");
                    renderHandlebarTemplateHtml(place, html, 'clear-append');  
                    bindExperienceTemplate();
                     
                    work_experience_block = json.candidate_experiences.length;
                    if( work_experience_block > 5 ) {
                        $("#add_experience_btn").hide();
                    }
                    if( work_experience_block <= 0  ) {
                        $("#delete_experience_btn").hide();
                    }
                    
                    $("#add_experience_btn").off("click").on("click", function() {
                        if( work_experience_block < 5 ) { 
                            addWorkExperience();
                            
                            work_experience_block++;
                            if( work_experience_block >= 5 ) {
                                $("#add_experience_btn").hide();
                            }
                            if( work_experience_block > 0 ) {
                                $("#delete_experience_btn").show();
                            }
                            bindExperienceTemplate();
                        }  
                    });
                    $("#delete_experience_btn").off("click").on("click", function() {
                        if( work_experience_block > 0 ) { 
                            $("#work_experiences_edit_detail_zone .work-experience-block:last-child").remove();
                            
                            work_experience_block--;
                            if( work_experience_block <= 0  ) {
                                $("#delete_experience_btn").hide();
                            }
                            if( work_experience_block < 5 ) {
                                $("#add_experience_btn").show();
                            } 
                            bindExperienceTemplate();
                        }  
                    }); 
                } 
            } 
            hideWaitMe($("#work_experiences_form"));
        }
    );
}
function addWorkExperience() {
    var data = {
        count: work_experience_block
    };
    var select_source = $("#work_experiences_form_template_single").html();
    var select_template = Handlebars.compile(select_source);
    var html = select_template(data);
    var place = $("#work_experiences_edit_detail_zone");
    renderHandlebarTemplateHtml(place, html, 'append');
}
function getCandidateEducation() { 
    showWaitMe($("#education_form"), "โปรดรอสักครู่");
    callAPI(
        {
            request_id: "candidate_educations", 
            url: _config.server_url + "/candidate-educations",
            method: "GET"
        },
        function(json) {
            if(json.error_code == 0) {
                if( typeof json.candidate_educations != 'undefined') {  
                    var obj_data = { 
                        candidate_educations: json.candidate_educations 
                    };  
                     
                    var select_source = $("#education_detail_edit_template").html();
                    var select_template = Handlebars.compile(select_source);
                    var html = select_template(obj_data); 
                    var place = $("#education_edit_detail_zone");
                    renderHandlebarTemplateHtml(place, html, 'clear-append'); 
                    
                    var obj_data = { 
                        candidate_educations: json.group_candidate_educations 
                    };  
                    var select_source = $("#education_detail_template").html();
                    var select_template = Handlebars.compile(select_source);
                    var html = select_template(obj_data);
                    var place = $("#education_detail");
                    renderHandlebarTemplateHtml(place, html, 'clear-append');  
                    bindEducationTemplate(); 

                    education_block = json.candidate_educations.length;
                    if( education_block > 10 ) {
                        $("#add_education_btn").hide();
                    }
                    if( education_block <= 0  ) {
                        $("#delete_education_btn").hide();
                    }
                    
                    $("#add_education_btn").off("click").on("click", function() {
                        if( education_block < 10 ) { 
                            addEducation();
                            
                            education_block++;
                            if( education_block >= 10 ) {
                                $("#add_education_btn").hide();
                            }
                            if( education_block > 0 ) {
                                $("#delete_education_btn").show();
                            }
                            bindEducationTemplate();
                        }  
                    });
                    $("#delete_education_btn").off("click").on("click", function() {
                        if( education_block > 0 ) { 
                            $("#education_edit_detail_zone .education-block:last-child").remove(); 
                            education_block--;
                            if( education_block <= 0  ) {
                                $("#delete_education_btn").hide();
                            }
                            if( education_block < 10 ) {
                                $("#add_education_btn").show();
                            } 
                            bindEducationTemplate();
                        }  
                    }); 
                } 
            } 
            hideWaitMe($("#education_form"));
        }
    );
}
function addEducation() {
    var data = {
        count: education_block
    };
    var select_source = $("#education_detail_edit_single_template").html();
    var select_template = Handlebars.compile(select_source);
    var html = select_template(data);
    var place = $("#education_edit_detail_zone");
    renderHandlebarTemplateHtml(place, html, 'append');  
     
}
function bindEducationTemplate() {
    if( typeof edu_validator != 'undefined' && edu_validator != null ) {
        edu_validator.destroy();
    }
    edu_validator = $('#education_form').validate({
        focus: function () {
            $(this).closest('form').validate().settings.onkeyup = false;
        },
        blur: function (input) {
            $(this).closest('form').validate().settings.onkeyup = $.validator.defaults.onkeyup;
        },
        rules: { 
            
        },
        messages: {
             
        },
        highlight: function (input) {
             
        },
        unhighlight: function (input) {
             
        },
        submitHandler: function (form) {
            var data = $(form).serializeJSON();
            callAPI(
                {
                    request_id: "educations",
                    data: data,
                    url: "http://e-recruit.me/candidate-educations",
                    method: "POST"
                },
                function(json) {
                    if(json.error_code == 0) {
                        getCandidateEducation();
                        $(".education-form-btn-toggle-mode.education-form-detail").trigger('click');
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
    
    $(".education-form-btn-toggle-mode").off('click');
    $(".education-form-btn-toggle-mode").on('click', function() {  
        $( '.education-form-detail' ).toggleClass( "d-none" );
        $( '.education-form-edit' ).toggleClass( "d-none" );  
    });
    $( "#education_form .require-input" ).each(function(k,e) {   
        $( e ).rules( "add", {
            required: true, 
            messages: {
              required: label.errors.required,
            }
        }); 
    }); 
    $( "#education_form .require-select" ).each(function(k,e) {  
        $( e ).rules( "add", {
            required: true, 
            messages: {
              required: label.errors.required,
            }
        });
    });
}
function bindExperienceTemplate() {
    if( typeof exp_validator != 'undefined' && exp_validator != null ) {
        exp_validator.destroy();
    }
    $('#work_experiences_form').removeData('validator');
    $('#work_experiences_form').removeData('unobtrusiveValidation');
    
    exp_validator = $('#work_experiences_form').validate({
        focus: function () {
            $(this).closest('form').validate().settings.onkeyup = false;
        },
        blur: function (input) {
            $(this).closest('form').validate().settings.onkeyup = $.validator.defaults.onkeyup;
        },
        rules: { 
            
        },
        messages: {
             
        },
        highlight: function (input) {
             
        },
        unhighlight: function (input) {
             
        },
        submitHandler: function (form) {
              
            var data = $(form).serializeJSON();
            callAPI(
                {
                    request_id: "work_experience",
                    data: data,
                    url: "http://e-recruit.me/candidate-experiences",
                    method: "POST"
                },
                function(json) {
                    if(json.error_code == 0) {
                        getCandidateWorkExperiences();
                        $(".work-experience-form-btn-toggle-mode.work-experience-form-detail").trigger('click');
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
    
    $(".work-experience-form-btn-toggle-mode").off('click');
    $(".work-experience-form-btn-toggle-mode").on('click', function() {  
        $( '.work-experience-form-detail' ).toggleClass( "d-none" );
        $( '.work-experience-form-edit' ).toggleClass( "d-none" );  
    });
    $( "#work_experiences_form .require-input" ).each(function(k,e) {   
        $( e ).rules( "add", {
            required: true, 
            messages: {
              required: label.errors.required,
            }
        }); 
    }); 
    $( "#work_experiences_form .require-select" ).each(function(k,e) {  
        $( e ).rules( "add", {
            required: true, 
            messages: {
              required: label.errors.required,
            }
        });
    });
}
function bindProfileTemplate() {
    if( typeof pro_validator != 'undefined' && pro_validator != null ) {
        pro_validator.destroy();
    }
    pro_validator = $('#profile_form_edit').validate({
        focus: function () {
            $(this).closest('form').validate().settings.onkeyup = false;
        },
        blur: function (input) {
            $(this).closest('form').validate().settings.onkeyup = $.validator.defaults.onkeyup;
        },
        rules: { 
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
        },
        highlight: function (input) {
             
        },
        unhighlight: function (input) {
             
        },
        submitHandler: function (form) {
            var data = { 
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
                    request_id: "update_profile",
                    data: data,
                    url: "http://e-recruit.me/profile",
                    method: "PUT"
                },
                function(json) {
                    if(json.error_code == 0) {
                        getCandidateProfile();
                        $(".profile-form-btn-toggle-mode.profile-form-detail").trigger('click');
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

    $(".profile-form-btn-toggle-mode").off('click');
    $(".profile-form-btn-toggle-mode").on('click', function() {  
        $( '.profile-form-detail' ).toggleClass( "d-none" ); 
        $( '.profile-form-edit' ).toggleClass( "d-none" );
    });

    $('#form_date_of_birth').datepicker('destroy');
    dob_picker = $('#form_date_of_birth').datepicker({
        format: 'dd/mm/yyyy', 
        endDate: '-1d',
        language: 'th'
    }).datepicker('setDate',  new Date($('#form_date_of_birth').val()) ); 
}
function getApplications(current_page) {
    if( typeof current_page == 'undefined' || current_page == null ) {
        current_page = 1;
    }
    showWaitMe($("#profile_application_list"), "โปรดรอสักครู่");
    callAPI(
        {
            request_id: "applications", 
            url: _config.server_url + "/applications?page=" + current_page,
            method: "GET"
        },
        function(json) {
            if(json.error_code == 0) {
                if( typeof json.applications != 'undefined') {
                    var obj_data = {
                        applications: json.applications.data 
                    }  
                    var select_source = $("#profile_application_list_template").html();
                    var select_template = Handlebars.compile(select_source);
                    var html = select_template(obj_data);
                    var place = $("#profile_application_list");
                    renderHandlebarTemplateHtml(place, html, 'clear-append');
                    
                    current_page = json.applications.current_page;
                    var last_page = json.applications.last_page;
                    var previous_page = current_page - 1;
                    if( previous_page <= 0 ) {
                        previous_page = null;
                    }
                    var next_page = current_page + 1;
                    if( next_page > last_page ) {
                        next_page = null;
                    } 
                    
                    var obj_data = {
                        last_page: last_page,
                        previous_page: previous_page,
                        next_page: next_page
                    }  
                    var select_source = $("#profile_application_pagination_template").html();
                    var select_template = Handlebars.compile(select_source);
                    var html = select_template(obj_data);
                    var place = $("#profile_application_pagination");
                    renderHandlebarTemplateHtml(place, html, 'clear-append');
                    bindPagination();
                } 
            } 
            hideWaitMe($("#profile_application_list"));
        }
    );
}

function setHelper() {
    Handlebars.registerHelper('applicationStatusName', function(value, options) {
        if( value == 'hired') {
            return 'รับเข้าทำงาน';
        } else if( value == 'appointed_for_interview' ) {
            return 'นัดสัมภาษณ์งาน';
        } else if( value == 'in_review' ) {
            return 'กำลังพิจารณา';
        } else if( value == 'rejected' ) {
            return 'ถูกปฏิเสธ';
        }  
        return 'รอดำเนินการ';
    });
    Handlebars.registerHelper('applicationStatusClass', function(value, options) {
        if( value == 'hired') {
            return 'success';
        } else if( value == 'appointed_for_interview' ) {
            return 'info';
        } else if( value == 'in_review' ) {
            return 'primary';
        } else if( value == 'rejected' ) {
            return 'danger';
        }  
        return 'warning';
    });
    Handlebars.registerHelper('ifCond', function (v1, operator, v2, options) {

        switch (operator) {
            case '==':
                return (v1 == v2) ? options.fn(this) : options.inverse(this);
            case '===':
                return (v1 === v2) ? options.fn(this) : options.inverse(this);
            case '!=':
                return (v1 != v2) ? options.fn(this) : options.inverse(this);
            case '!==':
                return (v1 !== v2) ? options.fn(this) : options.inverse(this);
            case '<':
                return (v1 < v2) ? options.fn(this) : options.inverse(this);
            case '<=':
                return (v1 <= v2) ? options.fn(this) : options.inverse(this);
            case '>':
                return (v1 > v2) ? options.fn(this) : options.inverse(this);
            case '>=':
                return (v1 >= v2) ? options.fn(this) : options.inverse(this);
            case '&&':
                return (v1 && v2) ? options.fn(this) : options.inverse(this);
            case '||':
                return (v1 || v2) ? options.fn(this) : options.inverse(this);
            default:
                return options.inverse(this);
        }
    });
    Handlebars.registerHelper('listPagination', function(item, options) {
        var out = '';  
        
        for(var i = 1; i <= item; i++) {
            var class_active = '';
            if( i == current_page ) {
                class_active = ' active ';
            } 
            out = out + '<li class="page-item '+class_active+'"><a class="page-link" data-page="'+i+'">' + i + '</a></li>';
        } 
        return new Handlebars.SafeString( out );
    });
    Handlebars.registerHelper('convertGender', function(value, options) {
        if(value == "F") {
            return "หญิง";
        } else {
            return "ชาย";
        }
    }); 
    Handlebars.registerHelper('convertMilitary', function(value, options) {
        if(value == "discharge") {
            return "ผ่านการเกณฑ์ทหาร";
        } else if(value == "military_studied") {
            return "ศึกษาวิชาทหาร";
        } else {
            return "ได้รับการยกเว้น";
        }
    }); 
    Handlebars.registerHelper('convertDate', function(value, options) {
        return moment(value).format("DD/MM/YYYY"); 
    }); 
    Handlebars.registerHelper('listYear', function(item, options) {
        var out = '';  
        for(var i = 1990; i <= 2019; i++) {
            var class_active = '';
            if( i == item ) {
                class_active = ' selected ';
            } 
            out = out + '<option value ="'+i+'" '+class_active+' >' + i + '</option>';
        } 
        return new Handlebars.SafeString( out );
    });
    Handlebars.registerHelper('convertEducationLevel', function(value, options) {
        if(value == "doctorate") {
            return "ปริญญาเอก";
        } else if(value == "master") {
            return "ปริญญาโท";
        } else {
            return "ปริญญาตรี";
        }
    });  
 
}
 
function range(start, count) {
    return Array.apply(0, Array(count))
        .map((element, index) => index + start);
}
function bindPagination() {
    $('a[data-page]').off('click');
    $('a[data-page]').on('click', function() {
        current_page = $(this).attr('data-page');
        getApplications(current_page);
    });
}