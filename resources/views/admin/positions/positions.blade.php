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
                                <h3 class="mb-0">ตำแหน่งงาน</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{ url('admin/positions/add') }}" class="btn btn-sm btn-outline-success">เพิ่ม</a>  
                            </div>
                        </div>
                    </div>
                    <div id ="user_list_card" class="card-body">
                        <div class="col-12">
                            <table id="position_list_table" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">ตำแหน่ง</th> 
                                        <th scope="col">สถานะ</th>
                                        <th scope="col"></th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($positions as $position)
                                        <tr>
                                            <th scope="row" width="40%">
                                                <div class="media align-items-center"> 
                                                    <div class="media-body">
                                                        <span class="mb-0 text-sm">{{$position->job_name}}</span>
                                                    </div>
                                                </div>
                                            </th> 
                                            <td width="30%">
                                                <span class="badge badge-dot mr-4">
                                                    <i class="bg-{{$position->color}}"></i> {{$position->status}}
                                                </span>
                                            </td>  
                                            <td class="text-right" width="30%">
                                                <a href="{{ url("admin/positions/edit/{$position->id}") }}" class="btn btn-sm btn-outline-info">แก้ไข</a> 
                                                <a href="{{ url("admin/positions/delete/{$position->id}") }}" class="btn btn-sm btn-outline-danger">ลบ</a> 
                                                 
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
            $('#position_list_table').DataTable({
                "columnDefs": [{
                    "targets": 2,
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
