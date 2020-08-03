<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
 
use Carbon\Carbon;
session_start();

class AdminController extends Controller
{
     
    public function index(Request $request, Response $response)
    {
        $first_date = date("Y-m-d", strtotime('first day of this month'));
        $last_date = date("Y-m-d", strtotime('last day of this month'));

        $pending = DB::table('application_forms')
                        ->where('status', 'pending')
                        ->whereBetween('submitted_datetime', [ $first_date, $last_date ])
                        ->count();
        $interview = DB::table('application_forms')
                        ->where('status', 'appointed_for_interview')
                        ->whereBetween('submitted_datetime', [ $first_date, $last_date ])
                        ->count();
        $in_review = DB::table('application_forms')
                        ->where('status', 'in_review')
                        ->whereBetween('submitted_datetime', [ $first_date, $last_date ])
                        ->count();
        $hired = DB::table('application_forms')
                        ->where('status', 'hired')
                        ->whereBetween('submitted_datetime', [ $first_date, $last_date ])
                        ->count(); 
        $interviews = DB::table('application_forms')
                        ->join('candidates', 'candidates.id', '=', 'application_forms.candidate_id')
                        ->join('jobs', 'jobs.id', '=', 'application_forms.job_id')
                        ->where('application_forms.status', 'appointed_for_interview')
                        ->where('interview_datetime', '>=', date("Y-m-d 00:00:00"))
                        ->where('interview_datetime', '<=', date("Y-m-d 23:59:59"))
                        ->where('jobs.status', 'active')
                        ->select('application_forms.id', 'first_name', 'last_name', 'job_name','interview_datetime')
                        ->orderBy('interview_datetime', 'ASC')
                        ->get();
        
        foreach($interviews as $key => $value) { 
            $interviews[$key]->interview_datetime =  date("Y-m-d H:i", strtotime( $value->interview_datetime ));
        } 
         
        $current_menu = 'dashboard';
        return view( 'admin.index', compact('current_menu', 'pending', 'interview',  'in_review', 'hired',  'interviews'));
    }
    public function login(Request $request, Response $response)
    {
        $errors = "";
        
        if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])) { 
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']); 
        }  
        
        return view( 'admin.login', compact('errors') );
    }
    public function logout(Request $request, Response $response)
    {
        unset($_SESSION['errors']); 
        setcookie("login_admin_session", '', time()-(3600*24*7)); 
        unset($_COOKIE['login_admin_session']); 
        return redirect('admin/login');
    }
    public function auth(Request $request, Response $response)
    {
        if (!$request->filled(['username', 'password'])) {
            $_SESSION['errors'] = "กรุณากรอกชื่อผู้ใช้และรหัสผ่าน";
            return redirect('admin/login');
        }  
        $username = $request->input('username');
        $password = $request->input('password');
        $users = DB::table('admins')->where('username', $username)->where('status', 'active')->first(); 
        if( empty($users) or ( !Hash::check($password, $users->password) ) ) {
            $_SESSION['errors'] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง"; 
            return redirect('admin/login');
        }
        $token_data = array(
            "id" => $users->id, 
        ); 
        setcookie("login_admin_session", $this->encodeUserToken($token_data), time()+(3600*24*7)); 
        return redirect('admin');
        
    }
}