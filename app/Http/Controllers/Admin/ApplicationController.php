<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
 
use Carbon\Carbon;

session_start(); 
class ApplicationController extends Controller
{ 
    public function index(Request $request, Response $response)
    {
        $applications = DB::table('application_forms')
                        ->join('candidates', 'candidates.id', '=', 'application_forms.candidate_id')
                        ->join('jobs', 'jobs.id', '=', 'application_forms.job_id')
                        ->join('departments', 'jobs.department_id', '=', 'departments.id')
                        ->where('application_forms.status', '!=', 'hired') 
                        ->where('jobs.status', 'active')
                        ->select('application_forms.id', 'departments.name', 'first_name', 'last_name', 'job_name', 'submitted_datetime', 'application_forms.status')
                        ->orderBy('submitted_datetime', 'DESC')
                        ->get();     
        foreach($applications as $key => $application) {
            if($application->status == 'pending') {
                $color = 'yellow';
                $status_name = 'รอดำเนินการ';
            } else if($application->status == 'appointed_for_interview') {
                $color = 'warning';
                $status_name = 'นัดสัมภาษณ์';
            } else if($application->status == 'in_review') {
                $color = 'info';
                $status_name = 'รอพิจารณา';
            } else if($application->status == 'rejected') {
                $color = 'danger';
                $status_name = 'ปฏิเสธ';
            } else   {
                $color = 'success';
                $status_name = 'รับเข้าทำงาน';
            }
            $applications[$key]->color = $color;
            $applications[$key]->status_name = $status_name;
        }
        $current_menu = 'applications';
        return view( 'admin.applications.applications', compact('applications', 'current_menu'));
    }
    public function view(Request $request, $id)
    {
        $errors = "";
        $applications = DB::table('application_forms')
                        ->join('candidates', 'candidates.id', '=', 'application_forms.candidate_id')
                        ->join('jobs', 'jobs.id', '=', 'application_forms.job_id')
                        ->join('departments', 'jobs.department_id', '=', 'departments.id') 
                        ->where('application_forms.id', $id) 
                        ->select('job_name', 'departments.name as department_name', 'application_forms.status as status_name', 'interview_datetime', 'gender', 'candidate_id', 'military_status', 'email', 'identification_number', 'first_name', 'last_name', 'phone_number', 'date_of_birth', 'nationality', 'race', 'address', 'application_forms.id')
                        ->first();     
        if( empty($applications) ) {
            return redirect('/admin/applications');
        }
        
        $applications->interview_hour = "";
        $applications->interview_min = "";
        $applications->interview_date = "";
        $is_today_interview = false;
        if(!empty($applications->interview_datetime)) {
            $date = explode(" ", $applications->interview_datetime);
            $time = explode( ":", $date[1] ); 
            $applications->interview_hour = $time[0];
            $applications->interview_min = $time[1]; 
            $applications->interview_date = date("Y-m-d", strtotime($date[0])); 
            if( $applications->interview_date == date("Y-m-d") ) {
                $is_today_interview = true;
            }
        } 
        $candidate_id = $applications->candidate_id;

        if( $applications->gender == "M" ) {
            $applications->gender = "ชาย";
        } else {
            $applications->gender = "หญิง";
        }
        if( $applications->military_status == "exempt" ) {
            $applications->military_status = "ได้รับการยกเว้น";
        } else if( $applications->military_status == "military_studied" ) {
            $applications->military_status = "ศึกษาวิชาทหาร";
        } else {
            $applications->military_status = "ผ่านการเกณฑ์ทหาร";
        }

        if($applications->status_name == 'pending') { 
            $status_name = 'รอดำเนินการ';
        } else if($applications->status_name == 'appointed_for_interview') { 
            $status_name = 'นัดสัมภาษณ์';
        } else if($applications->status_name == 'in_review') { 
            $status_name = 'รอพิจารณา';
        } else if($applications->status_name == 'rejected') { 
            $status_name = 'ปฏิเสธ';
        } else { 
            $status_name = 'รับเข้าทำงาน';
        } 
        $applications->status_name = $status_name;

        $candidate_experiences = DB::table('candidate_experiences')
                    ->where('candidate_id', $candidate_id ) 
                    ->select('organization_name', 'position', 'start_period', 'end_period')
                    ->orderBy('start_period', 'desc')
                    ->orderBy('end_period', 'desc')
                    ->get();  
          
        $candidate_educations = DB::table('candidate_educations')
                    ->where('candidate_id', $candidate_id ) 
                    ->select('education_level', 'institution_name', 'faculty', 'major', 'gpa', 'start_period', 'end_period')
                    ->orderBy('start_period', 'desc')
                    ->orderBy('end_period', 'desc')
                    ->get(); 
        $group_candidate_educations = array();
        foreach($candidate_educations as $candidate_education) {
            $group_candidate_educations[$candidate_education->education_level][] = $candidate_education;
        }
        $current_menu = 'applications';
         
        if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
        }
        return view( 'admin.applications.view', compact('current_menu', 'applications', 'group_candidate_educations', 'candidate_experiences', 'errors', 'is_today_interview'));
    }
    public function update(Request $request, $id)
    { 
        $applications = DB::table('application_forms')
                        ->join('candidates', 'candidates.id', '=', 'application_forms.candidate_id')
                        ->join('jobs', 'jobs.id', '=', 'application_forms.job_id')
                        ->join('departments', 'jobs.department_id', '=', 'departments.id')
                        ->where('application_forms.id', $id) 
                        ->first();     
                        
        if( empty($applications) ) {
            return redirect('/admin/applications');
        }

        $update_type = $request->input('update_type');
        $interview_date = $request->input('interview_date');
        if(!empty($interview_date)) {
            $interview_date = Carbon::createFromFormat('d/m/Y', $interview_date)->format('Y-m-d');
        }
        $interview_hour = $request->input('interview_hour');
        $interview_min = $request->input('interview_min');
        if( $update_type == "นัดวันสัมภาษณ์" and ( empty($interview_date) or empty($interview_hour) or  empty($interview_min) ) ) {
            $_SESSION['errors'] = "กรุณาเลือกวันเวลาที่ต้องการนัดสัมภาษณ์";
            $redirect_back_url = "/admin/applications/view/{$id}";
        }  else {
            $update_params = array();
            $redirect_back_url = "/admin/applications/view/{$id}";
            if( $update_type == "นัดวันสัมภาษณ์" ) {
                $status = 'appointed_for_interview';
                $update_params['interview_datetime'] = $interview_date . " " . $interview_hour . ":" .$interview_min .":00";
                $interview_date_format = Carbon::createFromFormat('Y-m-d', $interview_date)->format('d/m/Y');
                $text_email = "ได้ถูกนัดหมายวันสัมภาษณ์แล้ว ในวันที่ {$interview_date_format} เวลา {$interview_hour}:{$interview_min} น. "; 
            } else if( $update_type == "รอพิจารณา" ) { 
                $status = 'in_review';
                $update_params['interview_datetime'] = null;
                $text_email = "กำลังอยู่ในระหว่างการพิจารณา"; 
            } else if( $update_type == "รับเข้าทำงาน" ) {
                $status = 'hired';
                $update_params['interview_datetime'] = null;
                $redirect_back_url = "/admin/applications/";
                $text_email = "ได้รับการพิจารณาให้เข้าทำงานในตำแหน่งนี้แล้ว"; 
            } else if( $update_type == "ปฏิเสธ" ) {
                $status = 'rejected';
                $update_params['interview_datetime'] = null;
                $text_email = "ถูกปฏิเสธ"; 
            } 
            $update_params['status'] = $status;
            $application_forms = DB::table('application_forms')->where([
                ['id', '=', $id],
                ['status', '!=', 'hired'] 
            ])->first();
            
            if( $application_forms ) {   
                $affected = DB::table('application_forms')
                            ->where('id',  $id)
                            ->update(
                                $update_params
                            );
                $email_params = array(
                    "to_name" => "{$applications->first_name} {$applications->last_name}",
                    "to" => "{$applications->email}", 
                    "position" => $applications->job_name,
                    "status_text" => $text_email
                );
                
                $this->sendApplicationFormNotifyEmail($email_params);
            }  
        } 
        
        return redirect($redirect_back_url); 
    }
}