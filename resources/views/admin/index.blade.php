@extends('admin.template') 
@section('title', 'e-Recruitment Admin')
@section('header')
    <link type="text/css" href="{{ url('assets/vendor/dataTables/datatables.min.css') }}" rel="stylesheet"> 
@endsection
@section('content')
<div class="main-content">
    <div class="header bg-gradient-primary pb-4 pt-4 pt-md-4">
        <div class="container-fluid">
            <div class="header-body"> 
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">รอดำเนินการ</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$pending}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">นัดสัมภาษณ์</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$interview}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                 
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">รอพิจารณา</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$in_review}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                 
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">รับเข้าทำงาน</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$hired}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
    <div class="row">
            <div class="col-md-12">
                <div class="container-fluid mt-2">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">รายการนัดสัมภาษณ์วันนี้</h3>
                                </div> 
                            </div>
                        </div>
                        <div id ="table_interview_card" class="card-body">
                            <div class="col-12">
                                <table id="interview_list_table" class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">วันที่ เวลา</th>
                                            <th scope="col">ชื่อ - สกุล</th> 
                                            <th scope="col">ตำแหน่ง</th> 
                                            <th scope="col"></th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($interviews as $interview)
                                            <tr>
                                                <th scope="row" width="20%">
                                                    <div class="media align-items-center"> 
                                                        <div class="media-body">
                                                            <span class="mb-0 text-sm">{{$interview->interview_datetime}}</span>
                                                        </div>
                                                    </div>
                                                </th> 
                                                <td width="30%"> 
                                                    <div class="media-body">
                                                        <span class="mb-0 text-sm">{{$interview->first_name}} {{$interview->last_name}}</span>
                                                    </div> 
                                                </th> 
                                                <td width="30%">
                                                    <div class="media-body">
                                                        <span class="mb-0 text-sm">{{$interview->job_name}}</span>
                                                    </div>
                                                </td>  
                                                <td class="text-right" width="20%">
                                                    <a href="{{ url("admin/applications/view/{$interview->id}") }}" class="btn btn-sm btn-outline-info">ดูใบสมัครงาน</a>  
                                                </td>
                                            </tr>
                                        @endforeach 
                                    </tbody>
                                </table>
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
    
<script>
    $(document).ready(function() {
        $('#interview_list_table').DataTable({
            "columnDefs": [{
                "targets": 3,
                "orderable": false
            }],
            "language": {
                "paginate": {
                    "next": "&gt;",
                    "previous": "&lt;"
                },
                "emptyTable": "ไม่มีข้อมูล",
                "search": "ค้นหา",
                "info": "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                "infoEmpty": "แสดง 0 ถึง 0 จาก 0 รายการ",
                "infoFiltered": "(กรองจากทั้งหมด  _MAX_ รายการ",
                "zeroRecords": "ไม่พบรายการที่ค้นหา",
                "lengthMenu": "แสดง _MENU_ รายการ"
            }
        });
    } );
</script>
@endsection