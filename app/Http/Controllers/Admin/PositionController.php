<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
 
use Carbon\Carbon;
session_start();
class PositionController extends Controller
{
     
    public function index(Request $request, Response $response)
    {
        $positions = DB::table('jobs')
                    ->select('id', 'job_name', 'job_description', 'job_qualification', 'department_id', 'min_salary', 'max_salary', 'status')
                    ->where('status', '!=', 'deleted')
                    ->get();    
        foreach($positions as $key => $position) {
            if($position->status == 'active') {
                $positions[$key]->status = "ใช้งานอยู่";
                $positions[$key]->color = "success";
            }  else {
                $positions[$key]->status = "ยกเลิก";
                $positions[$key]->color = "danger";
            }
        } 
         
        $current_menu = 'positions';
        return view( 'admin.positions.positions', compact('positions', 'current_menu'));
    }
    public function add(Request $request, Response $response)
    { 
        $errors = "";
        if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
        } 
        $departments = DB::table('departments')
                ->select('id', 'name')
                ->where([
                    ['status', 'active'] 
                ])->get();
        $current_menu = 'positions';
        return view( 'admin.positions.add', compact('current_menu', 'departments', 'errors') );
    }
    public function create(Request $request, Response $response)
    { 
        $job_name = $request->input('name');
        $department_id = $request->input('department'); 
        $job_description = $request->input('description');
        $job_qualification = $request->input('qualification');
        $min_salary = $request->input('min_salary');
        $max_salary = $request->input('max_salary');

        if(empty($job_name) or empty($department_id) or empty( $job_description) or empty($job_qualification) or empty($min_salary) or empty($max_salary)) {
            $_SESSION['errors'] = "กรุณากรอกข้อมูลให้ครบถ้วน";
            return redirect('/admin/positions/add');
        } 
        if(($min_salary < 0) or ($max_salary < 0)) {
            $_SESSION['errors'] = "กรุณากรอกข้อมูลเงินเดือนเป็นเลขจำนวนเต็ม";
            return redirect('/admin/positions/add');
        }

        $status = 'active';
        $created_at = date("Y-m-d H:i:s");
        $errors = "";
     
        $id = DB::table('jobs')->insertGetId(
            compact('job_name', 'department_id', 'job_description', 'job_qualification', 'min_salary', 'max_salary', 'status', 'created_at')
        );
            
        if(!empty($_SESSION['errors'])) {
            return redirect('/admin/positions/add');
        } else {
            return redirect('/admin/positions');
        }  

    }
    public function edit(Request $request, $id)
    { 
        $errors = "";
       
        $positions = DB::table('jobs')->where([
            ['id', '=', $id],
            ['status', '=', 'active'] 
        ])->first();
        if( empty($positions)) {
            return redirect('/admin/positions');
        } 
        if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
        }  
        $departments = DB::table('departments')
                ->select('id', 'name')
                ->where([
                    ['status', 'active'] 
                ])->get();
        $current_menu = 'positions';
        return view( 'admin.positions.edit', compact('current_menu', 'positions', 'departments', 'errors') );
    }
    public function update(Request $request, $id)
    { 
        $job_name = $request->input('name');
        $department_id = $request->input('department'); 
        $job_description = $request->input('description');
        $job_qualification = $request->input('qualification');
        $min_salary = $request->input('min_salary');
        $max_salary = $request->input('max_salary');
        
        if(empty($job_name) or empty($department_id) or empty( $job_description) or empty($job_qualification) or empty($min_salary) or empty($max_salary)) {
            $_SESSION['errors'] = "กรุณากรอกข้อมูลให้ครบถ้วน";
            return redirect('/admin/positions/add');
        } 
        if( ($min_salary < 0) or ($max_salary < 0) ) {
            $_SESSION['errors'] = "กรุณากรอกข้อมูลเงินเดือนเป็นเลขจำนวนเต็ม";
            return redirect('/admin/positions/add');
        }

        $updated_at = date("Y-m-d H:i:s");
        $department = DB::table('departments')->where([
            ['id', '=', $id],
            ['status', '=', 'active'] 
        ])->first();
        
        if( $department ) { 
            $affected = DB::table('jobs')
                        ->where('id',  $id)
                        ->update(
                            compact('job_name', 'department_id', 'job_description', 'job_qualification', 'min_salary', 'max_salary',  'updated_at')
                        );
        }  
         if(!empty($_SESSION['errors'])) {
            return redirect('/admin/positions/edit');
        } else {
            return redirect('/admin/positions');
        } 

    }
    public function delete(Request $request, $id)
    {  
        $errors = "";
        $position = DB::table('jobs')->where([
            ['id', '=', $id],
            ['status', '=', 'active'] 
        ])->first();
        
        if( $position ) {
            $update_params = array(
                'status' => 'deleted',
                'updated_at' => date("Y-m-d H:i:s")
            ); 
            $affected = DB::table('jobs')
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
        return redirect('/admin/positions');

    }
}