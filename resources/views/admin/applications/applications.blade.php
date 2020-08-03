@extends('admin.template')
@section('title', 'e-Recruitment Admin')
@section('header')
    <link type="text/css" href="{{ url('assets/vendor/dataTables/datatables.min.css') }}" rel="stylesheet"> 
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
                                <h3 class="mb-0">ใบสมัครงาน</h3>
                            </div> 
                        </div>
                    </div>
                    <div id ="user_list_card" class="card-body">
                        <div class="col-12">
                            <table id="application_list_table" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">วันเวลาที่ส่งใบสมัคร</th>
                                        <th scope="col">ชื่อ - สกุล</th> 
                                        <th scope="col">ตำแหน่ง</th>
                                        <th scope="col">สถานะ</th>  
                                        <th scope="col"></th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applications as $application)
                                        <tr>
                                            <th scope="row" width="20%">
                                                {{$application->submitted_datetime}}
                                            </th> 
                                            <td width="30%">
                                                {{$application->first_name}} {{$application->last_name}}
                                            </td> 
                                            <td width="20%">
                                                {{$application->job_name}}
                                            </td>  
                                            <td width="20%">
                                                <span class="badge badge-dot mr-4">
                                                    <i class="bg-{{$application->color}}"></i> {{$application->status_name}}
                                                </span>
                                            </td> 
                                            <td class="text-right" width="10%">
                                                <a href="{{ url("admin/applications/view/{$application->id}") }}" class="btn btn-sm btn-outline-info">ดูใบสมัครงาน</a>  
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
            $('#application_list_table').DataTable({
                "columnDefs": [{
                    "targets": 4,
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
