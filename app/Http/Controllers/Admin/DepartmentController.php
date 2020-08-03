<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
 
use Carbon\Carbon;

session_start(); 
class DepartmentController extends Controller
{
     
    public function index(Request $request, Response $response)
    {
        $departments = DB::table('departments')
                    ->select('id', 'name', 'status')
                    ->where('status', '!=', 'inactive')
                    ->get();    
        foreach($departments as $key => $department) {
            if($department->status == 'active') {
                $departments[$key]->status = "ใช้งานอยู่";
                $departments[$key]->color = "success";
            }  else {
                $departments[$key]->status = "ยกเลิก";
                $departments[$key]->color = "danger";
            }
        } 
         
        $current_menu = 'departments';
        return view( 'admin.departments.departments', compact('departments', 'current_menu'));
    }
    public function add(Request $request, Response $response)
    { 
        $errors = "";
        if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
        } 
        $current_menu = 'departments';
        return view( 'admin.departments.add', compact('current_menu', 'errors') );
    }
    public function create(Request $request, Response $response)
    { 
        $department_name = $request->input('department_name');
        $errors = "";
        if(!empty($department_name)) {
            $user = DB::table('departments')->where([
                ['name', '=', $department_name] 
            ])->first(); 
            if( empty($user) ) { 
                $id = DB::table('departments')->insertGetId(
                    [
                        'name' => $department_name,  
                        'status' => 'active',  
                        'created_at' => date("Y-m-d H:i:s")
                    ]
                );
            } else {
                $_SESSION['errors'] = "มีแผนกนี้อยู่ในระบบแล้ว";
            }
        } else {
            $_SESSION['errors'] = "กรุณากรอกชื่อแผนก";
        } 
        if(!empty($_SESSION['errors'])) {
            return redirect('/admin/departments/add');
        } else {
            return redirect('/admin/departments');
        }  
    }
    public function edit(Request $request, $id)
    { 
        $errors = "";
        $departments = DB::table('departments')
                        ->select('id', 'name', 'status') 
                        ->where([
                            ['id', '=', $id],
                            ['status', '=', 'active'] 
                        ])->first();

        if( empty($departments)) {
            return redirect('/admin/departments');
        }
         
        if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
        }  
        $current_menu = 'departments';
        return view( 'admin.departments.edit', compact('current_menu', 'departments', 'errors') );
    }
    public function update(Request $request, $id)
    { 
        $name = $request->input('department_name');  
        if(empty($name) ) {
            $_SESSION['errors'] = "กรุณากรอกชื่อแผนก";
            return redirect('/admin/departments/add');
        } 
        $department = DB::table('departments')->where([
            ['id', '=', $id],
            ['status', '=', 'active'] 
        ])->first();
        
        if( $department ) {
            $update_params = array( 
                'name' => $name,
                'updated_at' => date("Y-m-d H:i:s")
            );
            
            $affected = DB::table('departments')
                        ->where('id',  $id)
                        ->update(
                            $update_params
                        );
            if(empty($affected)) {
                $_SESSION['errors'] = "ไม่สามารถแก้ไขได้ โปรดลองใหม่อีกครั้ง";
            }
        } else {
            $_SESSION['errors'] = "ไม่พบรายการนี้";
        }
        if(!empty($_SESSION['errors'])) {
            return redirect('/admin/departments/edit');
        } else {
            return redirect('/admin/departments');
        } 

    }
    public function delete(Request $request, $id)
    {  
        $errors = "";
        $department = DB::table('departments')->where([
            ['id', '=', $id],
            ['status', '=', 'active'] 
        ])->first();
        
        if( $department ) {
            $update_params = array(
                'status' => 'inactive',
                'updated_at' => date("Y-m-d H:i:s")
            ); 
            $affected = DB::table('departments')
                        ->where('id',  $id)
                        ->update(
                            $update_params
                        );
            if( empty($affected) ) {
                $_SESSION['errors'] = "ไม่สามารถลบได้ โปรดลองใหม่อีกครั้ง";
            }
        } else {
            $_SESSION['errors'] = "ไม่พบรายการนี้";
           
        }
        return redirect('/admin/departments');

    }
}