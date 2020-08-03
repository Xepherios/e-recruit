<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
 
use Carbon\Carbon;

class JobController extends Controller
{
     
    public function add(Request $request, Response $response)
    {
         
    }
    public function list(Request $request, Response $response)
    { 
        $keyword = trim( $request->input("keyword") ); 
        $department_id =trim( $request->input("department_id") ); 
         
        $conditions = array(
            array( 'jobs.status', '=', 'active')
        );
        if(!empty($keyword)) {
            $conditions[] = array(
                'job_name', 'like', "%{$keyword}%"
            );
        }
        if(!empty($department_id)) {
            $conditions[] = array(
                'jobs.department_id', '=', $department_id
            );
        }
        $jobs = array();
        $jobs = DB::table('jobs')
        ->join(
            'departments', 'jobs.department_id', '=', 'departments.id'
        )
        ->where( $conditions )
        ->select('jobs.id', 'job_name', 'job_description', 'min_salary', 'max_salary')
        ->orderBy('jobs.id', 'DESC')
        ->paginate(2);
        
        
        return response()->json(
            [
                'error_code' => 0,
                'jobs' => $jobs
            ], 
            200 
        ); 
    }
    
}