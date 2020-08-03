@extends('layouts.template') 
@section('title', 'ข้อมูลส่วนตัว')
@section('header')
    <link type="text/css" href="{{ url('assets/vendor/croppie/croppie.css') }}" rel="stylesheet"> 
@endsection
@section('content')
<section class="m-t-1em m-b-1em"> 
    <div class="container"> 
        <div class="row m-b-1em">
            <div class="nav-wrapper p-l-15 p-r-15">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs_personal_info" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true"><i class="ni ni-circle-08 mr-2"></i>ข้อมูลส่วนตัว</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs_application" data-toggle="tab" href="#application" role="tab" aria-controls="application" aria-selected="false"><i class="ni ni-bullet-list-67 mr-2"></i>ใบสมัครงาน</a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs_change_password" data-toggle="tab" href="#change_password" role="tab" aria-controls="change_password" aria-selected="false"><i class="ni ni-key-25 mr-2"></i>เปลี่ยนรหัสผ่าน</a>
                    </li> 
                </ul>
            </div>
        </div> 
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile">
                
                <div class="row mt-3">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <form id = "profile_form_edit"> 
                            <div class="row">  
                                <div class="col-md-12 mb-4">
                                    <div class="p-l-15 p-r-15 float-left"><h5>ข้อมูลส่วนตัว</h5></div> 
                                    <button class="btn btn-icon btn-2 btn-secondary float-right profile-form-detail profile-form-btn-toggle-mode" type="button">
                                        <span class="btn-inner--icon"><i class="fa fa-pencil"></i> แก้ไข</span> 
                                    </button>  
                                    <button class="btn btn-icon btn-2 btn-secondary float-right profile-form-edit profile-form-btn-save d-none" type="submit">
                                        <span class="btn-inner--icon"><i class="fa fa-floppy-o"></i> บันทึก </span> 
                                    </button> 
                                    <button class="btn btn-icon btn-2 btn-secondary float-right profile-form-edit profile-form-btn-toggle-mode mr-3 d-none" type="button">
                                        <span class="btn-inner--icon"><i class="fa fa-close"></i> ยกเลิก</span> 
                                    </button>
                                </div>
                            </div>
                            <div>
                                <div class="card"> 
                                    <div class="card-body">  
                                        <div id = "candidate_profile_form" style="min-height: 300px;">  
                                            <div id="profile_form_edit_detail"></div>
                                            <div id="profile_form_detail"></div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div> 
                @verbatim
                <script type="text/x-handlebars-template" id="candidate_profile_form_template">  
                    <div class="profile-form-edit d-none">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label for="form_email">อีเมล <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="form_email" name="email" autocomplete="off" value="{{candidate_data.email}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="form_identification_number">เลขประจำตัวประชาชน <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="form_identification_number" name="identification_number"  autocomplete="off" size="17" value="{{candidate_data.identification_number}}" disabled>
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label for="form_firstname">ชื่อ <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="form_firstname" name="first_name" placeholder="" autocomplete="off" value="{{candidate_data.first_name}}">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="form_lastname">นามสกุล <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="form_lastname" name="last_name" placeholder="" autocomplete="off" value="{{candidate_data.last_name}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label for="form_phone_number">เบอร์โทรศัพท์ <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="form_phone_number" name="phone_number" placeholder="" autocomplete="off" value="{{candidate_data.phone_number}}">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="form_date_of_birth">วันเกิด <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="form_date_of_birth" name="date_of_birth" autocomplete="off" value="{{candidate_data.date_of_birth}}">
                                </div>
                            </div>
                            
                        </div> 
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <label for="form_gender">เพศ <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select class="form-control" id="form_gender" name="gender" disabled> 
                                        <option value="M" {{#ifCond candidate_data.gender '==' 'M'}} selected {{/ifCond}}>ชาย</option>
                                        <option value="F" {{#ifCond candidate_data.gender '==' 'F'}} selected {{/ifCond}}>หญิง</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="form_military_status">สถานะการเกณฑ์ทหาร <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select class="form-control" id="form_military_status" name="military_status"> 
                                        <option value="exempt" {{#ifCond candidate_data.military_status '==' 'exempt'}} selected {{/ifCond}}>ได้รับการยกเว้น</option>
                                        <option value="military_studied" {{#ifCond candidate_data.military_status '==' 'military_studied'}} selected {{/ifCond}}>ศึกษาวิชาทหาร</option>
                                        <option value="discharge" {{#ifCond candidate_data.military_status '==' 'discharge'}} selected {{/ifCond}}>ผ่านการเกณฑ์ทหาร</option>
                                    </select>
                                </div>
                            </div>  
                            <div class="col-md-3 col-sm-12">
                                <label for="form_military_status">เชื้อชาติ <span class="text-danger">*</span></label> 
                                <div class="form-group">
                                    <input type="text" class="form-control" id="form_nationality" name="nationality" placeholder="" autocomplete="off" value="{{candidate_data.nationality}}">
                                </div>
                            </div>  
                            <div class="col-md-3 col-sm-12">
                                <label for="form_military_status">สัญชาติ <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="form_race" name="race" placeholder="" autocomplete="off" value="{{candidate_data.race}}">
                                </div>
                            </div>  
                        </div> 
                        <div class="row"> 
                            <div class="col-md-6 col-sm-12">
                                <label for="form_address">ที่อยู่</label>
                                <textarea class="form-control" id="form_address" name = "address" rows="3">{{candidate_data.address}}</textarea>
                            </div>  
                        </div>  
                    </div>
                </script>
                <script type="text/x-handlebars-template" id="candidate_profile_detail_template"> 
                    <div id = "profile_form_detail" class = "profile-form-detail">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label for="form_email">อีเมล</label>
                                <p>{{candidate_data.email}}</p>
                                
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="form_identification_number">เลขประจำตัวประชาชน</label>
                                <p>{{candidate_data.identification_number}}</p> 
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label for="form_firstname">ชื่อ</label>
                                <p>{{candidate_data.first_name}}</p>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="form_lastname">นามสกุล</label>
                                <p>{{candidate_data.last_name}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label for="form_phone_number">เบอร์โทรศัพท์</label>
                                <p>{{candidate_data.phone_number}}</p> 
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="form_date_of_birth">วันเกิด</label>
                                <p>{{convertDate candidate_data.date_of_birth}}</p>
                            </div> 
                        </div> 
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label for="form_gender">เพศ</label>
                                <p>{{convertGender candidate_data.gender}}</p>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="form_military_status">สถานะการเกณฑ์ทหาร</label>
                                <p>{{convertMilitary candidate_data.military_status}}</p>
                            </div>  
                            <div class="col-md-6 col-sm-12">
                                <label for="form_military_status">เชื้อชาติ</label> 
                                <p>{{candidate_data.nationality}}</p>
                            </div>  
                            <div class="col-md-6 col-sm-12">
                                <label for="form_military_status">สัญชาติ</label>
                                <p>{{candidate_data.race}}</p>
                            </div>  
                        </div> 
                        <div class="row"> 
                            <div class="col-md-6 col-sm-12">
                                <label for="form_address">ที่อยู่</label>
                                <p>{{candidate_data.address}}</p>
                            </div>  
                        </div> 
                    </div>  
                </script>
                @endverbatim 
                <div class="row mt-3">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <form id = "work_experiences_form"> 
                            <div class="row">
                                <div class="col-md-12 mb-4">  
                                    <div class="p-l-15 p-r-15 float-left"><h5>ประสบการณ์ทำงาน</h5></div>  
                                    <button class="btn btn-icon btn-2 btn-secondary float-right work-experience-form-detail work-experience-form-btn-toggle-mode" type="button">
                                        <span class="btn-inner--icon"><i class="fa fa-pencil"></i> แก้ไข</span> 
                                    </button>  
                                    <button class="btn btn-icon btn-2 btn-secondary float-right work-experience-form-edit work-experience-btn-save d-none" type="submit">
                                        <span class="btn-inner--icon"><i class="fa fa-floppy-o"></i> บันทึก </span> 
                                    </button> 
                                    <button class="btn btn-icon btn-2 btn-secondary float-right work-experience-form-edit work-experience-form-btn-toggle-mode mr-3 d-none" type="button">
                                        <span class="btn-inner--icon"><i class="fa fa-close"></i> ยกเลิก</span> 
                                    </button>
                                </div>
                            </div>  
                            <div class="card"> 
                                <div class="card-body"> 
                                    <div id="work_experiences_edit_detail" class="work-experience-form-edit d-none">
                                        <div id = "work_experiences_edit_detail_zone">
                                        </div> 
                                        <div class="row">
                                            <div class="col-md-2 col-sm-3">
                                                <button id = "add_experience_btn" class="btn btn-block btn-icon btn-2 btn-primary" type="button">
                                                    <span class="btn-inner--icon"><i class="ni ni-fat-add"></i> เพิ่ม</span> 
                                                </button>
                                            </div>
                                            <div class="col-md-2 col-sm-3">
                                                <button id = "delete_experience_btn" class="btn btn-block btn-icon btn-2 btn-primary" type="button">
                                                    <span class="btn-inner--icon"><i class="ni ni-fat-delete"></i> ลบ</span> 
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="work_experiences_detail" class="work-experience-form-detail">  
                                    </div> 
                                </div>
                            </div> 
                        </form>
                    </div>
                </div>
                @verbatim
                <script type="text/x-handlebars-template" id="work_experiences_form_template_single"> 
                    <div class = "work-experience-block">
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <label for="year_start">ปีที่เริ่ม<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select class="form-control require-select" name="work_experiences[{{count}}][start_year]"> 
                                        {{listYear start_period}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="year_start">ปีที่สิ้นสุด<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select class="form-control require-select" name="work_experiences[{{count}}][end_year]"> 
                                        {{listYear end_period}}
                                    </select>
                                </div>
                            </div> 
                            <div class="col-md-6 col-sm-12">
                                <label for="form_company_name">บริษัท <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" class="form-control require-input" name="work_experiences[{{count}}][company_name]" placeholder="" autocomplete="off" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label for="form_position">ตำแหน่ง <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" class="form-control require-input" name="work_experiences[{{count}}][position]" placeholder="" autocomplete="off" value="">
                                </div>
                            </div> 
                        </div> 
                    </div>
                </script>
                <script type="text/x-handlebars-template" id="work_experiences_form_template"> 
                    {{#each candidate_experiences}}
                        <div class = "work-experience-block">
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <label>ปีที่เริ่ม<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <select class="form-control require-select" name="work_experiences[{{@index}}][start_year]"> 
                                            {{listYear start_period}} 
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label>ปีที่สิ้นสุด<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <select class="form-control require-select" name="work_experiences[{{@index}}][end_year]"> 
                                            {{listYear end_period}}
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-md-6 col-sm-12">
                                    <label>บริษัท <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="text" class="form-control require-input" name="work_experiences[{{@index}}][company_name]" placeholder="" autocomplete="off" value="{{organization_name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-md-6 col-sm-12">
                                    <label>ตำแหน่ง <span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="text" class="form-control require-input" name="work_experiences[{{@index}}][position]" placeholder="" autocomplete="off" value="{{position}}">
                                    </div>
                                </div> 
                            </div> 
                        </div>
                    {{/each}}
                </script>
                <script type="text/x-handlebars-template" id="work_experiences_detail_template"> 
                    {{#each candidate_experiences}} 
                        <div class = "work-experience-block">
                            <div class="row">
                                <div class="col-md-3 col-sm-4">
                                    <h5>{{start_period}} - {{end_period}}</h5>
                                </div> 
                                <div class="col-md-9 col-sm-8">
                                    <h5>{{organization_name}}</h5>
                                </div> 
                            </div>
                            <div class="row">  
                                <div class="col-md-3 col-sm-4"></div> 
                                <div class="col-md-9 col-sm-8">
                                    {{position}} 
                                </div> 
                            </div>  
                        </div>
                    {{/each}}
                </script>
                @endverbatim 

                <div class="row mt-3">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <form id = "education_form"> 
                            <div class="row">
                                <div class="col-md-12 mb-4">  
                                    <div class="p-l-15 p-r-15 float-left"><h5>การศึกษา</h5></div>  
                                    <button class="btn btn-icon btn-2 btn-secondary float-right education-form-detail education-form-btn-toggle-mode" type="button">
                                        <span class="btn-inner--icon"><i class="fa fa-pencil"></i> แก้ไข</span> 
                                    </button>  
                                    <button class="btn btn-icon btn-2 btn-secondary float-right education-form-edit education-btn-save d-none" type="submit">
                                        <span class="btn-inner--icon"><i class="fa fa-floppy-o"></i> บันทึก </span> 
                                    </button> 
                                    <button class="btn btn-icon btn-2 btn-secondary float-right education-form-edit education-form-btn-toggle-mode mr-3 d-none" type="button">
                                        <span class="btn-inner--icon"><i class="fa fa-close"></i> ยกเลิก</span> 
                                    </button>
                                </div>
                            </div>  
                            <div class="card"> 
                                <div class="card-body">  
                                    <div id = "education_edit_detail" class="education-form-edit d-none"> 
                                        <div id = "education_edit_detail_zone"> 
                                        </div> 
                                        <div class="row">
                                            <div class="col-md-2 col-sm-3">
                                                <button id = "add_education_btn" class="btn btn-block btn-icon btn-2 btn-primary" type="button">
                                                    <span class="btn-inner--icon"><i class="ni ni-fat-add"></i> เพิ่ม</span> 
                                                </button>
                                            </div>
                                            <div class="col-md-2 col-sm-3">
                                                <button id = "delete_education_btn" class="btn btn-block btn-icon btn-2 btn-primary" type="button">
                                                    <span class="btn-inner--icon"><i class="ni ni-fat-delete"></i> ลบ</span> 
                                                </button>
                                            </div>
                                        </div> 
                                    </div> 
                                    <div id = "education_detail" class="education-form-detail">  
                                    </div> 
                                </div> 
                            </div> 
                        </form>
                    </div>
                </div> 
                @verbatim
                <script type="text/x-handlebars-template" id="education_detail_edit_template"> 
                    {{#each candidate_educations}}  
                    <div class = "education-block">
                        <div class="row">  
                            <div class="col-md-3 col-sm-12">
                                <label>ระดับการศึกษา<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select class="form-control require-select" name="educations[{{@index}}][education_level]"> 
                                        <option value="bachelor" {{#ifCond education_level '==' 'bachelor'}} selected {{/ifCond}}>ปริญญาตรี</option>
                                        <option value="master" {{#ifCond education_level '==' 'master'}} selected {{/ifCond}}>ปริญญาโท</option>
                                        <option value="doctorate" {{#ifCond education_level '==' 'doctorate'}} selected {{/ifCond}}>ปริญญาเอก</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <label>ปีที่เข้าศึกษา<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select class="form-control require-select" name="educations[{{@index}}][start_year]"> 
                                        {{listYear start_period}} 
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label>ปีที่จบการศึกษา<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select class="form-control require-select" name="educations[{{@index}}][end_year]"> 
                                        {{listYear end_period}} 
                                    </select>
                                </div>
                            </div> 
                            <div class="col-md-6 col-sm-12">
                                <label>ชื่อมหาวิทยาลัย <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" class="form-control require-input" name="educations[{{@index}}][institution_name]" placeholder="" autocomplete="off" value="{{institution_name}}">
                                </div>
                            </div> 
                        </div> 
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label>คณะ <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" class="form-control require-input" name="educations[{{@index}}][faculty]" placeholder="" autocomplete="off" value="{{faculty}} ">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label>สาขา <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" class="form-control require-input" name="educations[{{@index}}][major]" placeholder="" autocomplete="off" value="{{major}}">
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label>เกรดเฉลี่ย <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" class="form-control require-input" name="educations[{{@index}}][gpa]" placeholder="" autocomplete="off" value="{{gpa}}">
                                </div>
                            </div>
                        </div>
                    </div>         
                    {{/each}}
                </script>
                <script type="text/x-handlebars-template" id="education_detail_edit_single_template">  
                    <div class = "education-block">
                        <div class="row">  
                            <div class="col-md-3 col-sm-12">
                                <label>ระดับการศึกษา<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select class="form-control" name="educations[{{count}}][education_level]"> 
                                        <option value="bachelor" {{#ifCond education_level '==' 'bachelor'}} selected {{/ifCond}}>ปริญญาตรี</option>
                                        <option value="master" {{#ifCond education_level '==' 'master'}} selected {{/ifCond}}>ปริญญาโท</option>
                                        <option value="doctorate" {{#ifCond education_level '==' 'doctorate'}} selected {{/ifCond}}>ปริญญาเอก</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <label>ปีที่เข้าศึกษา<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select class="form-control require-select" name="educations[{{count}}][start_year]"> 
                                        {{listYear start_period}} 
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label>ปีที่จบการศึกษา<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <select class="form-control require-select" name="educations[{{count}}][end_year]"> 
                                        {{listYear end_period}} 
                                    </select>
                                </div>
                            </div> 
                            <div class="col-md-6 col-sm-12">
                                <label>ชื่อมหาวิทยาลัย <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" class="form-control require-input" name="educations[{{count}}][institution_name]" placeholder="" autocomplete="off" value="{{institution_name}}">
                                </div>
                            </div> 
                        </div> 
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label>คณะ <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" class="form-control require-input" name="educations[{{count}}][faculty]" placeholder="" autocomplete="off"  value="{{faculty}}">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label>สาขา <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" class="form-control require-input" name="educations[{{count}}][major]" placeholder="" autocomplete="off" value="{{major}}">
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label>เกรดเฉลี่ย <span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input type="text" class="form-control require-input" name="educations[{{count}}][gpa]" placeholder="" autocomplete="off" value="{{gpa}}">
                                </div>
                            </div>
                        </div> 
                    </div>
                </script>
                <script type="text/x-handlebars-template" id="education_detail_template"> 
                    {{#if candidate_educations.doctorate}}
                        <div class="row">  
                            <div class="col-md-6 col-sm-12">
                                <h4 class="text-muted">ปริญญาเอก</h4>
                            </div>
                        </div> 
                        <hr />
                    {{/if}}
                    {{#each candidate_educations.doctorate}}   
                        <div class = "education-block mb-3">
                            <div class="row">
                                <div class="col-md-3 col-sm-4">
                                    <h5>{{start_period}} - {{end_period}}</h5>
                                </div> 
                                <div class="col-md-9 col-sm-8">
                                    <h5>{{institution_name}}</h5>
                                </div> 
                            </div>
                            <div class="row">  
                                <div class="col-md-3 col-sm-4"></div> 
                                <div class="col-md-9 col-sm-8">
                                    <b>คณะ</b> {{faculty}} 
                                </div> 
                            </div>
                            <div class="row">  
                                <div class="col-md-3 col-sm-4"></div> 
                                <div class="col-md-9 col-sm-8">
                                    <b>สาขา</b> {{major}} 
                                </div> 
                            </div>  
                            <div class="row">  
                                <div class="col-md-3 col-sm-4"></div> 
                                <div class="col-md-9 col-sm-8">
                                    <b>เกรดเฉลี่ย</b> {{gpa}} 
                                </div> 
                            </div>
                        </div> 
                    {{/each}}
                    {{#if candidate_educations.master}}
                        <div class="row">  
                            <div class="col-md-6 col-sm-12">
                                <h4 class="text-muted">ปริญญาโท</h4>
                            </div>
                        </div> 
                        <hr />
                    {{/if}}
                    {{#each candidate_educations.master}}  
                        
                        <div class = "education-block mb-3">
                            <div class="row">
                                <div class="col-md-3 col-sm-4">
                                    <h5>{{start_period}} - {{end_period}}</h5>
                                </div> 
                                <div class="col-md-9 col-sm-8">
                                    <h5>{{institution_name}}</h5>
                                </div> 
                            </div>
                            <div class="row">  
                                <div class="col-md-3 col-sm-4"></div> 
                                <div class="col-md-9 col-sm-8">
                                    <b>คณะ</b> {{faculty}} 
                                </div> 
                            </div>
                            <div class="row">  
                                <div class="col-md-3 col-sm-4"></div> 
                                <div class="col-md-9 col-sm-8">
                                    <b>สาขา</b> {{major}} 
                                </div> 
                            </div>  
                            <div class="row">  
                                <div class="col-md-3 col-sm-4"></div> 
                                <div class="col-md-9 col-sm-8">
                                    <b>เกรดเฉลี่ย</b> {{gpa}} 
                                </div> 
                            </div>
                        </div> 
                    {{/each}}
                    {{#if candidate_educations.bachelor}}
                        <div class="row">  
                            <div class="col-md-6 col-sm-12">
                                <h4 class="text-muted">ปริญญาตรี</h4>
                            </div>
                        </div> 
                        <hr />
                    {{/if}}
                    {{#each candidate_educations.bachelor}}   
                        <div class = "education-block mb-3">
                            <div class="row">
                                <div class="col-md-3 col-sm-4">
                                    <h5>{{start_period}} - {{end_period}}</h5>
                                </div> 
                                <div class="col-md-9 col-sm-8">
                                    <h5>{{institution_name}}</h5>
                                </div> 
                            </div>
                            <div class="row">  
                                <div class="col-md-3 col-sm-4"></div> 
                                <div class="col-md-9 col-sm-8">
                                    <b>คณะ</b> {{faculty}} 
                                </div> 
                            </div>
                            <div class="row">  
                                <div class="col-md-3 col-sm-4"></div> 
                                <div class="col-md-9 col-sm-8">
                                    <b>สาขา</b> {{major}} 
                                </div> 
                            </div>  
                            <div class="row">  
                                <div class="col-md-3 col-sm-4"></div> 
                                <div class="col-md-9 col-sm-8">
                                    <b>เกรดเฉลี่ย</b> {{gpa}} 
                                </div> 
                            </div>
                        </div> 
                    {{/each}}
                </script>
                @endverbatim 
            </div>
            <div class="tab-pane fade" id="application" role="tabpanel" aria-labelledby="application">
                <div class="row">
                    <div class="p-l-15 p-r-15"><h5>ใบสมัครงาน</h5></div> 
                </div>
                <div id = "profile_application_list" class="row" style="min-height: 300px;"> 
                </div>
                <div id = "profile_application_pagination" class="row">
                </div>
                @verbatim
                    <script type="text/x-handlebars-template" id="profile_application_list_template">
                        {{#each applications}}
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="card bg-secondary mb-3"> 
                                    <div class="card-header"> 
                                        <b>{{job_name}}</b>
                                    </div>
                                    <div class="card-body" style="min-height: 180px;">
                                        <p>สถานะ :  <span class="badge badge-pill badge-{{ applicationStatusClass status }}">{{ applicationStatusName status }}</span></p>
                                        {{#ifCond status "==" "appointed_for_interview"}}
                                            {{#if interview_datetime}}
                                                <p>วันเวลาที่นัดสัมภาษณ์ : {{interview_datetime}}</p> 
                                            {{/if}}
                                        {{/ifCond}} 
                                        <p>วันที่สมัคร : {{submitted_datetime}}</p> 
                                    </div>
                                </div>
                            </div>
                        {{/each}} 
                    </script>
                    <script type="text/x-handlebars-template" id="profile_application_pagination_template">
                        <div class="col"></div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <li class="page-item {{#ifCond previous_page "<=" "0"}} disabled {{/ifCond}}">
                                        <a class="page-link" aria-label="Previous" data-page="{{previous_page}}">
                                            <i class="fa fa-angle-left"></i>
                                            <span class="sr-only">ก่อนหน้า</span>
                                        </a>
                                    </li>
                                    {{listPagination last_page}}
                                    <li class="page-item {{#ifCond next_page "<=" "0"}} disabled {{/ifCond}}">
                                        <a class="page-link" aria-label="Next" data-page="{{next_page}}">
                                            <i class="fa fa-angle-right"></i>
                                            <span class="sr-only">ถัดไป</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav> 
                        </div>
                        <div class="col"></div> 
                    </script>
                @endverbatim
            </div>
            <div class="tab-pane fade" id="change_password" role="tabpanel" aria-labelledby="change_password">
                <div class="row">
                    <div class="p-l-15 p-r-15"><h5>เปลี่ยนรหัสผ่าน</h5></div> 
                </div>
                <div class="row">
                    <div class="col"></div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="card"> 
                            <div class="card-body">
                                <form id = "change_password_form"> 
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <label for="form_old_password">รหัสผ่าน</label>
                                            <div class="form-group">
                                                <input type="password" class="form-control" id="form_old_password" name="old_password" placeholder="" autocomplete="off">
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <label for="form_password">รหัสผ่านใหม่ <span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <input type="password" class="form-control" id="form_password" name="password" placeholder="" autocomplete="off">
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <label for="form_password_again">รหัสผ่านใหม่ (อีกครั้ง)<span class="text-danger">*</span></label>
                                            <div class="form-group">
                                                <input type="password" class="form-control" id="form_password_again" name="password_again" placeholder="" autocomplete="off">
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="row"> 
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary my-4">ยืนยัน</button>
                                        </div> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> 
                    <div class="col"></div>
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
    <script src="{{ url('assets/vendor/croppie/exif.js') }}"></script> 
    <script src="{{ url('assets/vendor/croppie/croppie.min.js') }}"></script> 
    <script src="{{ url('assets/vendor/moment/moment.min.js') }}"></script>
    <script src="{{ url('assets/vendor/jquery/serialize-json.min.js') }}"></script>
    <script src="{{ url('assets/js/profile.js') }}"></script>
@endsection