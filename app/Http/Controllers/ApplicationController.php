<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
 
use Carbon\Carbon;

class ApplicationController extends Controller
{
     
    public function add(Request $request, Response $response)
    {
        if(empty( $_COOKIE['login_session_token'] )) {
            return response()->json(
                [
                    'error' => 1,
                    'error_message' => 'กรุณาเข้าสู่ระบบก่อน'
                ], 
                401
            );
        }
        $decoded_token = $this->decodeToken($_COOKIE['login_session_token']);
        if(empty($decoded_token->sub)) {
            return response()->json(
                [
                    'error' => 1,
                    'error_message' => 'กรุณาเข้าสู่ระบบก่อน'
                ], 
                401
            );
        }
        $candidate_id = $decoded_token->sub;
        $job_id = $request->input('job_id'); 
        $job = DB::table('jobs')->where([
            ['id', '=', $job_id],
            ['status', '=', 'active'], 
        ])->first();

        if (empty($job)) {
            return response()->json(
                [
                    'error' => 1,
                    'error_message' => 'ไม่พบตำแหน่งงานนี้'
                ], 
                404
            ); 
        }
          
        $candidate_education = DB::table('candidate_educations')->where([
            ['candidate_id', '=', $candidate_id],
        ])->first();

        if(empty($candidate_education)) {
            return response()->json(
                [
                    'error' => 1,
                    'error_message' => 'กรุณาระบุข้อมูลการศึกษาก่อนส่งใบสมัครงาน'
                ], 
                400 
            ); 
        }
        $candidate = DB::table('application_forms')->where([
            ['job_id', '=', $job_id],
            ['candidate_id', '=', $candidate_id], 
            ['status', '!=', 'rejected']
        ])->first();
        
        if ($candidate) {
            return response()->json(
                [
                    'error' => 1,
                    'error_message' => 'สามารถส่งใบสมัครได้สูงสุดครั้งละ 1 ใบ หากยังไม่ได้'
                ], 
                400 
            ); 
        }  
          
        $id = DB::table('application_forms')->insertGetId(
            [
                'candidate_id' => $candidate_id, 
                'job_id' => $job_id, 
                'submitted_datetime' => date("Y-m-d H:i:s"),  
            ]
        );
        if(empty($id)) {
            return response()->json(
                [
                    'error' => 1,
                    'error_message' => 'ไม่สามารถส่งใบสมัครได้ โปรดลองใหม่อีกครั้ง'
                ], 
                400 
            ); 
        } 
        return response()->json(
            [
                'error_code' => 0, 
            ], 
            201
        ); 
    }
    public function list(Request $request, Response $response)
    { 
        if(empty( $_COOKIE['login_session_token'] )) {
            return response()->json(
                [
                    'error' => 1,
                    'error_message' => 'กรุณาเข้าสู่ระบบก่อน'
                ], 
                401
            );
        }
        $decoded_token = $this->decodeToken($_COOKIE['login_session_token']);
        if(empty($decoded_token->sub)) {
            return response()->json(
                [
                    'error' => 1,
                    'error_message' => 'กรุณาเข้าสู่ระบบก่อน'
                ], 
                401
            );
        }
        $candidate_id = $decoded_token->sub;
        $applications = array();
        $applications = DB::table('application_forms')
        ->join(
            'jobs', 'application_forms.job_id', '=', 'jobs.id'
        )
        ->join(
            'departments', 'jobs.department_id', '=', 'departments.id'
        )
        ->where( 
            [
                ['candidate_id', "=", $candidate_id],
                ['jobs.status', "=", 'active'],
                ['departments.status', "=", 'active']
            ]
        )
        ->select('jobs.id', 'job_name', 'job_description', 'departments.name as department_name', 'min_salary', 'max_salary', 'application_forms.status', 'interview_datetime', 'submitted_datetime')
        ->orderBy('submitted_datetime', 'DESC')
        ->paginate(10);
  
        return response()->json(
            [
                'error_code' => 0,
                'applications' => $applications
            ], 
            200 
        ); 
    }
}