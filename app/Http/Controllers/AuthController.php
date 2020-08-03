<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Firebase\JWT\JWT;

class AuthController extends Controller
{
     
    public function authenticate(Request $request, Response $response)
    {

        if (!$request->filled(['email', 'password'])) {
            return response()->json(
                [
                    'error' => 1,
                    'error_message' => 'กรุณากรอกอีเมลหรือรหัสผ่าน'
                ], 
                400 
            ); 
        } 
         
        $email = $request->input('email');
        $password = $request->input('password');
        $candidate = DB::table('candidates')
                        ->where('email', $email)
                        ->first(); 
        if( empty($candidate) or ( !Hash::check($password, $candidate->password) ) ) {
            return response()->json(
                [
                    'error' => 1,
                    'error_message' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง'
                ], 
                400 
            ); 
        }
        if( $candidate->status == 'pending' ) {
            return response()->json(
                [
                    'error' => 1,
                    'error_message' => 'กรุณายืนยันอีเมลก่อน'
                ], 
                400 
            ); 
        } else if ( $candidate->status != 'active'  ) {
            return response()->json(
                [
                    'error' => 1,
                    'error_message' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง'
                ], 
                400 
            ); 
        }

        $token_data = array(
            "id" => $candidate->id, 
        );
        return response()->json(
            [
                'error_code' => 0,
                'token' => $this->encodeUserToken($token_data)
            ], 
            200 
        ); 
    }
    public function changePassword(Request $request, Response $response)
    {
        $candidate_info = array();
        if(empty( $_COOKIE['login_session_token'] )) {
            return redirect('login');
        }
        $decoded_token = $this->decodeToken($_COOKIE['login_session_token']);
        if(empty($decoded_token->sub)) {
            return redirect('login');
        }
        $candidate_id = $decoded_token->sub;
        $candidate = DB::table('candidates')->where([
            ['id', "=", $candidate_id],
            ['status', "=", 'active']
        ])->first(); 

        if (!$request->filled(['old_password', 'password', 'password_again'])) {
            return response()->json(
                [
                    'error' => 1,
                    'error_message' => 'กรุณากรอกรหัสผ่าน'
                ], 
                400 
            ); 
        } 
         
        $old_password = $request->input('old_password');
        $password = $request->input('password');
        $password_again = $request->input('password_again');
        
        if( !Hash::check($old_password, $candidate->password) ) {
            return response()->json(
                [
                    'error' => 1,
                    'error_message' => 'รหัสผ่านเดิมไม่ถูกต้อง'
                ], 
                400 
            ); 
        }
        $affected = DB::table('candidates')->where('id', $candidate->id)->update(['password' => Hash::make($password)]); 
        return response()->json(
            [
                'error_code' => 0, 
            ], 
            200 
        ); 
    }
}