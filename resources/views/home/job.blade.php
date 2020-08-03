@extends('layouts.template') 
@section('title', $job_data["job_name"])
@section('header')
     
@endsection
@section('content')
<section class="m-t-1em m-b-1em">
    <div class="container"> 
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="card"> 
                    <div class="card-body"> 
                        <div class="col-md-12 pl-1 pr-1">
                            <h4 class="job-header pb-1">{{$job_data["job_name"]}}</h4>
                        </div>
                        <div class="col-md-12 pl-3 pr-3 pt-1"> 
                            <h6 class="mb-2"><b>หน้าที่และความรับผิดชอบ</b></h6> 
                                <div class="mb-3 pl-4">
                                    {!! $job_data["job_description"] !!}
                                </div>
                            <h6 class="mb-2"><b>คุณสมบัติผู้สมัคร</b></h6>
                                <div class="mb-3 pl-4">
                                    {!! $job_data["job_qualification"] !!}
                                </div>
                            <h6 class="mb-2"><b>เงินเดือน</b></h6>
                                <p class="pl-4">{{$job_data["min_salary"]}} - {{$job_data["max_salary"]}} บาท</p>
                            <br /> 
                        </div>
                        <div class="col-md-12 pl-3 pr-3 pt-1">
                            <input type = "hidden" id="job_id" value="{{$job_data["id"]}}" />
                            <button id = "apply_job_btn" type="button" class="btn btn-primary" @if (($job_data["is_job_applied"]) === true) disabled @endif>สมัครงาน</button> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('footer')
    <script src="{{ url('assets/js/job.js') }}"></script>
@endsection