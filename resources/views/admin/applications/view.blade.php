@extends('admin.template')
@section('title', 'e-Recruitment Admin')
@section('header')
    <link type="text/css" href="{{ url('assets/vendor/dataTables/datatables.min.css') }}" rel="stylesheet"> 
    <style> 
        #user_list_card label{
            font-weight: bold;
        }
    </style> 
@endsection
@section('content')
<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="container-fluid mt-2">
                <div class="card bg-secondary shadow mb-3"> 
                    <div class="card-body">
                        @if ($errors)
                            <div class="alert alert-warning alert-dismissible fade show" role="alert"> 
                                <span class="alert-inner--text">{{$errors}}</span> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="row mb-4">  
                            <div class="col-md-3 col-sm-6">
                                <b>ตำแหน่งงาน : </b> {{$applications->job_name}}
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <b>แผนก : </b> {{$applications->department_name}}
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <b>สถานะใบสมัครงาน : </b> {{$applications->status_name}}
                            </div>  
                        </div>
                        <div class="row"> 
                            <div class="col-lg-12 col-md-12 col-sm-12"> 
                                <form id = "application_update_form" method = "POST" action = "{{url("/admin/applications/update/{$applications->id}")}}">
                                    <div class="row mb-4"> 
                                        <div class="col-md-4 col-sm-12 mb-1"> 
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                </div>
                                                <input class="form-control" placeholder="วันสัมภาษณ์" id= "interview_date" name = "interview_date" type="text" value="{{$applications->interview_date}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-12 mb-1"> 
                                            <div class="input-group input-group-alternative">
                                                <select class="form-control" name="interview_hour"> 
                                                    @for ($i = 0; $i < 24; $i++)
                                                        <option value="{{sprintf('%02d', $i)}}" @if($applications->interview_hour == $i) selected @endif>{{sprintf('%02d', $i)}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-12 mb-1"> 
                                            <div class="input-group input-group-alternative">
                                                <select class="form-control" name="interview_min"> 
                                                    @for ($i = 0; $i < 59; $i++)
                                                        <option value="{{sprintf('%02d', $i)}}" @if($applications->interview_min == $i) selected @endif>{{sprintf('%02d', $i)}}</option>
                                                    @endfor 
                                                </select>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 mb-1"> 
                                            <input type="submit" class="btn btn-block btn-warning" name="update_type" value="นัดวันสัมภาษณ์"> 
                                        </div>
                                        <div class="col-md-3 col-sm-6 mb-1"> 
                                            <input type="submit" class="btn btn-block btn-info" name="update_type" value="รอพิจารณา"> 
                                        </div>
                                        <div class="col-md-3 col-sm-6 mb-1"> 
                                            <input type="submit" class="btn btn-block btn-success" name="update_type" value="รับเข้าทำงาน"> 
                                        </div>
                                        <div class="col-md-3 col-sm-6 mb-1"> 
                                            <input type="submit" class="btn btn-block btn-danger" name="update_type" value="ปฏิเสธ"> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">ใบสมัครงาน</h3>
                            </div> 
                        </div>
                    </div>
                    <div id ="user_list_card" class="card-body">
                        <div class="col-12"> 
                            <h2>ข้อมูลส่วนตัว</h2>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="form_email">อีเมล</label>
                                    <p>{{$applications->email}}</p> 
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="form_identification_number">เลขประจำตัวประชาชน</label>
                                    <p>{{$applications->identification_number}}</p> 
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="form_firstname">ชื่อ</label>
                                    <p>{{$applications->first_name}}</p>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="form_lastname">นามสกุล</label>
                                    <p>{{$applications->last_name}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="form_phone_number">เบอร์โทรศัพท์</label>
                                    <p>{{$applications->phone_number}}</p>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="form_date_of_birth">วันเกิด</label>
                                    <p>{{$applications->date_of_birth}}</p>
                                </div> 
                            </div> 
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="form_gender">เพศ</label>
                                    <p>{{$applications->gender}}</p>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="form_military_status">สถานะการเกณฑ์ทหาร</label>
                                    <p>{{$applications->military_status}}</p>
                                </div>  
                                <div class="col-md-6 col-sm-12">
                                        <label for="form_military_status">สัญชาติ</label>
                                        <p>{{$applications->nationality}}</p>
                                    </div>  
                                <div class="col-md-6 col-sm-12">
                                    <label for="form_military_status">เชื้อชาติ</label> 
                                    <p>{{$applications->race}}</p>
                                </div>   
                            </div> 
                            <div class="row"> 
                                <div class="col-md-6 col-sm-12">
                                    <label for="form_address">ที่อยู่</label>
                                    <p>{{$applications->address}}</p>
                                </div>  
                            </div>
                            <hr>
                            <h2>ประสบการณ์ทำงาน</h2>
                            <hr>
                            @if (count($candidate_experiences) <= 0)
                                <div class="text-muted">ไม่มีข้อมูล</div>
                            @else
                                @foreach($candidate_experiences as $candidate_experience)
                                    <div class = "work-experience-block mb-3" >
                                        <div class="row">
                                            <div class="col-md-3 col-sm-4">
                                                <h3>{{$candidate_experience->start_period}} - {{$candidate_experience->end_period}}</h3>
                                            </div> 
                                            <div class="col-md-9 col-sm-8">
                                                <h3>{{$candidate_experience->organization_name}}</h3>
                                            </div> 
                                        </div>
                                        <div class="row">  
                                            <div class="col-md-3 col-sm-4"></div> 
                                            <div class="col-md-9 col-sm-8">
                                                {{$candidate_experience->position}}
                                            </div> 
                                        </div>  
                                    </div>
                                @endforeach
                            @endif
                            <hr>
                            <h2>การศึกษา</h2>
                            <hr>  
                            @isset ($group_candidate_educations['doctorate']) 
                                <h5 class="text-muted">ปริญญาเอก</h5>
                                @foreach($group_candidate_educations['doctorate'] as $candidate_education)
                                    <div class = "education-block mb-3">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-4">
                                                <h3>{{$candidate_education->start_period}} - {{$candidate_education->end_period}}</h3>
                                            </div> 
                                            <div class="col-md-9 col-sm-8">
                                                <h3>{{$candidate_education->institution_name}}</h3>
                                            </div> 
                                        </div>
                                        <div class="row">  
                                            <div class="col-md-3 col-sm-4"></div> 
                                            <div class="col-md-9 col-sm-8">
                                                <b>คณะ</b> {{$candidate_education->faculty}}
                                            </div> 
                                        </div>
                                        <div class="row">  
                                            <div class="col-md-3 col-sm-4"></div> 
                                            <div class="col-md-9 col-sm-8">
                                                <b>สาขา</b> {{$candidate_education->major}}
                                            </div> 
                                        </div>  
                                        <div class="row">  
                                            <div class="col-md-3 col-sm-4"></div> 
                                            <div class="col-md-9 col-sm-8">
                                                <b>เกรดเฉลี่ย</b> {{$candidate_education->gpa}}
                                            </div> 
                                        </div>
                                    </div> 
                                @endforeach
                            @endisset
                            @isset ($group_candidate_educations['master']) 
                                <h5 class="text-muted">ปริญญาโท</h5>
                                @foreach($group_candidate_educations['master'] as $candidate_education)
                                    <div class = "education-block mb-3">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-4">
                                                <h3>{{$candidate_education->start_period}} - {{$candidate_education->end_period}}</h3>
                                            </div> 
                                            <div class="col-md-9 col-sm-8">
                                                <h3>{{$candidate_education->institution_name}}</h3>
                                            </div> 
                                        </div>
                                        <div class="row">  
                                            <div class="col-md-3 col-sm-4"></div> 
                                            <div class="col-md-9 col-sm-8">
                                                <b>คณะ</b> {{$candidate_education->faculty}}
                                            </div> 
                                        </div>
                                        <div class="row">  
                                            <div class="col-md-3 col-sm-4"></div> 
                                            <div class="col-md-9 col-sm-8">
                                                <b>สาขา</b> {{$candidate_education->major}}
                                            </div> 
                                        </div>  
                                        <div class="row">  
                                            <div class="col-md-3 col-sm-4"></div> 
                                            <div class="col-md-9 col-sm-8">
                                                <b>เกรดเฉลี่ย</b> {{$candidate_education->gpa}}
                                            </div> 
                                        </div>
                                    </div> 
                                @endforeach
                            @endisset
                            @isset ($group_candidate_educations['bachelor']) 
                                <h5 class="text-muted">ปริญญาตรี</h5>
                                @foreach($group_candidate_educations['bachelor'] as $candidate_education)
                                    <div class = "education-block mb-3">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-4">
                                                <h3>{{$candidate_education->start_period}} - {{$candidate_education->end_period}}</h3>
                                            </div> 
                                            <div class="col-md-9 col-sm-8">
                                                <h3>{{$candidate_education->institution_name}}</h3>
                                            </div> 
                                        </div>
                                        <div class="row">  
                                            <div class="col-md-3 col-sm-4"></div> 
                                            <div class="col-md-9 col-sm-8">
                                                <b>คณะ</b> {{$candidate_education->faculty}}
                                            </div> 
                                        </div>
                                        <div class="row">  
                                            <div class="col-md-3 col-sm-4"></div> 
                                            <div class="col-md-9 col-sm-8">
                                                <b>สาขา</b> {{$candidate_education->major}}
                                            </div> 
                                        </div>  
                                        <div class="row">  
                                            <div class="col-md-3 col-sm-4"></div> 
                                            <div class="col-md-9 col-sm-8">
                                                <b>เกรดเฉลี่ย</b> {{$candidate_education->gpa}}
                                            </div> 
                                        </div>
                                    </div> 
                                @endforeach
                            @endisset
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
    <script src="{{ url('assets/vendor/dataTables/datatables.min.js') }}"> </script>
    <script src="{{ url('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ url('assets/vendor/bootstrap-datepicker/locales/bootstrap-datepicker.th.min.js') }}"></script>
    <script>
        var interview_date = $('#interview_date').val(); 
        @if( $is_today_interview ) 
        var dob_picker = $('#interview_date').datepicker({
            format: 'dd/mm/yyyy', 
            startDate: '+0d',
            language: 'th'
        }).datepicker('setDate', new Date(interview_date)); 
        @else
        var dob_picker = $('#interview_date').datepicker({
            format: 'dd/mm/yyyy', 
            startDate: '+1d',
            language: 'th'
        }).datepicker('setDate', new Date(interview_date)); 
        @endif
    </script>
@endsection
