@extends('layouts.template') 
@section('title', 'ABC Company')
@section('content')
<section class="m-t-1em">
    <div class="container"> 
        <div class="row">
            <div class="col-md-12">
                <h5>ตำแหน่งงานที่เปิดรับสมัคร</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-xs-12">
                <div class="form-group">
                    <select class="form-control" name="department_id">
                        <option value="0">ทุกแผนก</option>
                        @foreach ($departments as $department)
                        <option value="{{$department->id}}">{{$department->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-10 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="keyword" placeholder="ตำแหน่งงานที่คุณสนใจ" autocomplete="off">
                </div>
            </div>
        </div>

        <div id = "jobs_list" class="row" style="min-height: 300px;">  
        </div>
        <div id = "jobs_list_pagination" class="row">
        </div>
        @verbatim 
            <script type="text/x-handlebars-template" id="jobs_list_template">
                {{#each jobs}}
                    <div class="col-md-6 col-lg-4 col-sm-12 m-b-1em">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{job_name}}</h5>  
                                <a href="http://e-recruit.me/job/{{id}}" class="btn btn-default btn-sm">รายละเอียด</a>
                            </div>
                        </div>
                    </div>
                {{/each}}
            </script>
            <script type="text/x-handlebars-template" id="jobs_pagination_template">
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
</section>
@endsection
@section('footer') 
    <script src="{{ url('assets/js/home.js') }}"></script>
@endsection
