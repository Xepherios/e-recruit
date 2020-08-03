<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
 
use Carbon\Carbon;
session_start();
class UserController extends Controller
{
     
    public function index(Request $request, Response $response)
    {
        $admins = DB::table('admins') 
                    ->select('id', 'username', 'status')
                    ->where('status', '!=', 'deleted')
                    ->get();    
        foreach($admins as $key => $admin) {
            if($admin->status == 'active') {
                $admins[$key]->status = "ใช้งานอยู่";
                $admins[$key]->color = "success";
            } else if ($admin->status == 'inactive') {
                $admins[$key]->status = "ไม่ใช้งาน";
                $admins[$key]->color = "warning";
            } else {
                $admins[$key]->status = "ยกเลิก";
                $admins[$key]->color = "danger";
            }
        } 
         
        $current_menu = 'admins';
        return view( 'admin.users.users', compact('admins', 'current_menu'));
    }
    public function add(Request $request, Response $response)
    { 
        $errors = array();
        if(isset($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
        } 
        $current_menu = 'admins';
        return view( 'admin.users.add', compact('current_menu', 'errors') );
    }
    public function create(Request $request, Response $response)
    { 
        $username = $request->input('username');
        $password = $request->input('password');
        $password_again = $request->input('password_again');

        $user = DB::table('admins')->where([
            ['username', '=', $username] 
        ])->first();
        
        if( empty($user) ) { 
            $id = DB::table('admins')->insertGetId(
                [
                    'username' => $username, 
                    'password' => Hash::make($password),
                    'status' => 'active',  
                    'created_at' => date("Y-m-d H:i:s")
                ]
            );
        } else {
            $_SESSION['errors'] = "ชื่อผู้ใช้นี้มีอยู่ในระบบแล้ว";
        }
        return redirect('/admin/users');

    }
    public function edit(Request $request, $id)
    { 
        $errors = "";
        if(isset($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
        } 
        $user = DB::table('admins')->where([
            ['id', '=', $id],
            ['status', '!=', 'deleted'] 
        ])->first();
        if( empty($user)) {
            return redirect('/admin/users');
        }
        $user_data = array(
            "id" => $user->id,
            "username" => $user->username,
            "status" => $user->status
        );  
        if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
        }  
        $current_menu = 'admins';
        return view( 'admin.users.edit', compact('current_menu', 'user_data', 'errors') );
    }
    public function update(Request $request, $id)
    { 
        $status = $request->input('status');
        $password = $request->input('password');
        
        $user = DB::table('admins')->where([
            ['id', '=', $id],
            ['status', '!=', 'deleted'] 
        ])->first();
        
        if( $user ) {
            $update_params = array(
                'status' => $status,
                'updated_at' => date("Y-m-d H:i:s")
            );
            if(!empty($password)) {
                $update_params['password'] = Hash::make($password);
            }
            $affected = DB::table('admins')
                        ->where('id',  $id)
                        ->update(
                            $update_params
                        );
        }  
        return redirect('/admin/users');

    }
    public function delete(Request $request, $id)
    {  
        $errors = "";
        $user = DB::table('admins')->where([
            ['id', '=', $id],
            ['status', '!=', 'deleted'] 
        ])->first();
        
        if( $user ) {
            $update_params = array(
                'status' => 'deleted',
                'updated_at' => date("Y-m-d H:i:s")
            ); 
            $affected = DB::table('admins')
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
        return redirect('/admin/users');

    }
}