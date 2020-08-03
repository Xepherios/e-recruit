<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    { 
        
        $candidate_info = array(); 
        if(!empty( $_COOKIE['login_session_token'] )) {
            $decoded_token = $this->decodeToken($_COOKIE['login_session_token']);
             
            if(!empty($decoded_token->sub)) { 
                $candidate_id = $decoded_token->sub;
                $candidate = DB::table('candidates')->select('first_name', 'last_name', 'email')->where([
                    ['id', "=", $candidate_id],
                    ['status', "=", 'active']
                ])->first();
                if( !empty($candidate) ) {
                    $candidate_info = array(
                        "candidate_id" => $candidate_id,
                        "name" => $candidate->first_name . " " . $candidate->last_name,
                        "email" => $candidate->email
                    );
                } 
            } 
        } 
        $departments = DB::table('departments')->where('status', 'active')->orderBy('name', 'asc')->get(); 
        return view( 'home.index', compact("departments", "candidate_info") );
    }
    public function register(Request $request)
    {  
        $candidate_info = array();
        if(!empty( $_COOKIE['login_session_token'] )) {
            $decoded_token = $this->decodeToken($_COOKIE['login_session_token']);
            if(!empty( $decoded_token->sub )) {
                return redirect('/');
            }
        }  
        return view( 'home.register', compact("candidate_info")  );
    }
    public function login(Request $request)
    {  
        $candidate_info = array();
        if(!empty( $_COOKIE['login_session_token'] )) {
            $decoded_token = $this->decodeToken($_COOKIE['login_session_token']);
            if(!empty( $decoded_token->sub )) {
                return redirect('/');
            }
        } 
         
        return view( 'home.login', compact("candidate_info")  ); 
    }
    public function logout(Request $request)
    {  
        $candidate_info = array();
        if(!empty( $_COOKIE['login_session_token'] )) {
            unset($_COOKIE['login_session_token']);
            setcookie('login_session_token', null, -1, '/'); 
        } 
        return redirect('login');
    }
    public function profile(Request $request)
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
          
        $candidate_info = array(
            "candidate_id" => $candidate_id,
            "name" => $candidate->first_name . " " . $candidate->last_name,
            "email" => $candidate->email
        );
         
        return view( 'home.profile', compact("candidate_info") );
    }
    public function job(Request $request, $id)
    {  
        $candidate_info = array();
        $candidate_id = 0;
        if(!empty( $_COOKIE['login_session_token'] )) {
            $decoded_token = $this->decodeToken($_COOKIE['login_session_token']);
             
            if(!empty($decoded_token->sub)) { 
                $candidate_id = $decoded_token->sub;
                $candidate = DB::table('candidates')->select('first_name', 'last_name', 'email')->where([
                    ['id', "=", $candidate_id],
                    ['status', "=", 'active']
                ])->first();
                if( !empty($candidate) ) {
                    $candidate_info = array(
                        "candidate_id" => $candidate_id,
                        "name" => $candidate->first_name . " " . $candidate->last_name,
                        "email" => $candidate->email
                    );
                } 
            } 
        } 
        $conditions = array(
            array( 'jobs.status', '=', 'active')
        );
        if(!empty($id)) {
            $conditions[] = array("jobs.id", '=', $id);
        } 
        $job = array();
        $job = DB::table('jobs')
        ->join(
            'departments', 'jobs.department_id', '=', 'departments.id'
        )
        ->where( $conditions )
        ->select('jobs.id', 'job_name', 'job_description', 'job_qualification', 'min_salary', 'max_salary')
        ->first();
         
        $job_data = array();
        if(!empty($job)) {

            $application_condition = array(
                ["job_id", "=", $job->id],
                ["status", "!=", "rejected"],
                ["candidate_id", "=", $candidate_id],
            );

            $is_applied = DB::table('application_forms')
                        ->where( $application_condition ) 
                        ->exists(); 
            
            $job_data = array( 
                "id" => $job->id,
                "job_name" => $job->job_name,
                "job_description" => nl2br($job->job_description),
                "job_qualification" => nl2br($job->job_qualification),
                "min_salary" => number_format($job->min_salary),
                "max_salary" => number_format($job->max_salary),
                "is_job_applied" => $is_applied
            );
            return view( 'home.job', compact("job_data", "candidate_info") );
        } else {
            return redirect('/'); 
        } 
    }
}