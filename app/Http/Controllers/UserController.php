<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
 
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{
     
    public function add(Request $request, Response $response)
    {
        if ($request->isJson()) {
            $params = $request->json()->all();
        }  
         
        $email = $params['email'];
        $password = $params['password'];
        $password_again = $params['password_again'];
        $identification_number = $params['identification_number'];
        $firstname = $params['first_name'];
        $lastname = $params['last_name'];
        $phone_number = $this->phoneFormat($params['phone_number']);
  
        $date_of_birth = Carbon::createFromFormat('d/m/Y', $params['date_of_birth'])->format('Y-m-d');
        $gender = $params['gender'];
        $military_status = $params['military_status'];
        $address = $params['address'];
        $race = $params['race'];
        $nationality = $params['nationality'];
        $candidate = DB::table('candidates')->where('email', $email)->first();
        if ($candidate) {
            return response()->json(
                [
                    'error_code' => 1,
                    'error_message' => 'อีเมลนี้ถูกใช้ไปแล้ว'
                ], 
                400 
            ); 
        }  
        $candidate = DB::table('candidates')->where('identification_number', $identification_number)->first(); 
        if ($candidate) {
            return response()->json(
                [
                    'error_code' => 1,
                    'error_message' => 'เลขประจำตัวประชาชนนี้ถูกใช้ไปแล้ว'
                ], 
                400 
            ); 
        }   
        $uuid = Uuid::uuid4()->toString();
        
        $id = DB::table('candidates')->insertGetId(
            [
                'email' => $email, 
                'identification_number' => $identification_number, 
                'password' => Hash::make($password), 
                'first_name' => $firstname,
                'last_name' => $lastname,
                'phone_number' => $phone_number,
                'date_of_birth' => $date_of_birth,
                'gender' => $gender,
                'military_status' => $military_status,
                'address' => $address,
                'race' => $race,
                'nationality' => $nationality,
                'verify_key' => $uuid
            ]
        );
        if(empty($id)) {
            return response()->json(
                [
                    'error_code' => 1,
                    'error_message' => 'ลงทะเบียนไม่สำเร็จ โปรดลองใหม่อีกครั้ง'
                ], 
                400 
            ); 
        } 
        $email_params = array(
            "to_name" => "{$firstname} {$lastname}",
            "to" => "{$email}", 
            "verify_key" => $uuid
        );
        $this->sendVerifyEmail($email_params);
        return response()->json(
            [
                'error_code' => 0, 
            ], 
            201
        ); 
    }
    public function list(Request $request, Response $response)
    {
 
    }

    public function read(Request $request, Response $response)
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
        $candidate = DB::table('candidates')
                    ->where('id', $candidate_id )
                    ->where('status', 'active')
                    ->select('identification_number', 'email', 'first_name', 'last_name', 'phone_number', 'date_of_birth', 'gender', 'nationality', 'race', 'military_status', 'address')
                    ->first();    
        if(empty($candidate)) {
            return response()->json(
                [
                    'error' => 1,
                    'error_message' => 'ไม่พบข้อมูล'
                ], 
                404 
            ); 
        }  
        return response()->json(
            [
                'error_code' => 0,
                'candidate' => $candidate 
            ], 
            200
        ); 
    }
     
    public function getCandidateWorkExperiences(Request $request, Response $response)
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
        $candidate = DB::table('candidates')
                    ->where('id', $candidate_id )
                    ->where('status', 'active')
                    ->select('id')
                    ->first();    
        if(empty($candidate)) {
            return response()->json(
                [
                    'error' => 1,
                    'error_message' => 'ไม่พบข้อมูล'
                ], 
                404 
            ); 
        } 
        $candidate_experiences = DB::table('candidate_experiences')
                    ->where('candidate_id', $candidate_id ) 
                    ->select('organization_name', 'position', 'start_period', 'end_period')
                    ->orderBy('start_period', 'desc')
                    ->orderBy('end_period', 'desc')
                    ->get();  
        return response()->json(
            [
                'error_code' => 0, 
                'candidate_experiences' => $candidate_experiences
            ], 
            200
        ); 
    }
    public function getCandidateEducations(Request $request, Response $response)
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
        $candidate = DB::table('candidates')
                    ->where('id', $candidate_id )
                    ->where('status', 'active')
                    ->select('id')
                    ->first();    
        if(empty($candidate)) {
            return response()->json(
                [
                    'error' => 1,
                    'error_message' => 'ไม่พบข้อมูล'
                ], 
                404 
            ); 
        } 
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
        return response()->json(
            [
                'error_code' => 0, 
                'candidate_educations' => $candidate_educations,
                'group_candidate_educations' => $group_candidate_educations 
            ], 
            200
        ); 
    }
    public function update(Request $request, Response $response)
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
        $candidate = DB::table('candidates')
                    ->where('id', $candidate_id )
                    ->where('status', 'active')
                    ->first();    
        if(empty($candidate)) {
            return response()->json(
                [
                    'error' => 1,
                    'error_message' => 'ไม่พบข้อมูล'
                ], 
                404 
            ); 
        }   
        if ($request->isJson()) {
            $params = $request->json()->all();
        } 
          
        $firstname = $params['first_name'];
        $lastname = $params['last_name'];
        $phone_number = $this->phoneFormat($params['phone_number']);
        
        $date_of_birth = Carbon::createFromFormat('d/m/Y', $params['date_of_birth'])->format('Y-m-d');
        $gender = $params['gender'];
        $military_status = $params['military_status'];
        $address = $params['address'];
        $race = $params['race'];
        $nationality = $params['nationality'];
        $affected = DB::table('candidates')
                    ->where('id',  $candidate_id)
                    ->update([
                        'first_name' => $firstname,
                        'last_name' => $lastname,
                        'phone_number' => $phone_number,
                        'date_of_birth' => $date_of_birth,
                        'gender' => $gender,
                        'military_status' => $military_status,
                        'nationality' => $nationality,
                        'race' => $race,
                        'address' => $address, 
                    ]);
        
        if( $affected === false ) {
            return response()->json(
                [
                    'error' => 1,
                    'error_message' => 'ไม่สามารถแก้ไขได้ โปรดลองใหม่อีกครั้ง'
                ], 
                400 
            ); 
        } 
        return response()->json(
            [
                'error_code' => 0, 
            ], 
            200
        ); 
    }
    public function updateCandidateWorkExperiences(Request $request, Response $response)
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
        $candidate = DB::table('candidates')
                    ->where('id', $candidate_id )
                    ->where('status', 'active')
                    ->first();    
        if(empty($candidate)) {
            return response()->json(
                [
                    'error' => 1,
                    'error_message' => 'ไม่พบข้อมูล'
                ], 
                404 
            ); 
        }   
        if ($request->isJson()) {
            $params = $request->json()->all();
        } 
        $affected = DB::table('candidate_experiences')
                        ->where('candidate_id',  $candidate_id)
                        ->delete();
        
        if( $affected === false ) {
            return response()->json(
                [
                    'error' => 1,
                    'error_message' => 'ไม่สามารถแก้ไขได้ โปรดลองใหม่อีกครั้ง'
                ], 
                400 
            ); 
        }  
        $insert_data = array();
        if(!empty($params['work_experiences'])) {
            foreach( $params['work_experiences'] as $work_experience ) {
                $insert_data[] = array(
                    "candidate_id" => $candidate_id,
                    "start_period" =>  $work_experience['start_year'],
                    "end_period" => $work_experience['end_year'],
                    "organization_name" => $work_experience['company_name'],
                    "position" => $work_experience['position'], 
                );
            }
            if( !empty($insert_data) ) {
                $affected = DB::table('candidate_experiences')->insert($insert_data);
            }
            if( $affected === false ) {
                return response()->json(
                    [
                        'error' => 1,
                        'error_message' => 'ไม่สามารถแก้ไขได้ โปรดลองใหม่อีกครั้ง'
                    ], 
                    400 
                ); 
            } 
        } 
          
        return response()->json(
            [
                'error_code' => 0, 
            ], 
            200
        ); 
    }
    public function updateCandidateEducations(Request $request, Response $response)
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
        $candidate = DB::table('candidates')
                    ->where('id', $candidate_id )
                    ->where('status', 'active')
                    ->first();    
        if(empty($candidate)) {
            return response()->json(
                [
                    'error' => 1,
                    'error_message' => 'ไม่พบข้อมูล'
                ], 
                404 
            ); 
        }   
        if ($request->isJson()) {
            $params = $request->json()->all();
        } 
        $affected = DB::table('candidate_educations')
                        ->where('candidate_id',  $candidate_id)
                        ->delete();
        
        if( $affected === false ) {
            return response()->json(
                [
                    'error' => 1,
                    'error_message' => 'ไม่สามารถแก้ไขได้ โปรดลองใหม่อีกครั้ง'
                ], 
                400 
            ); 
        }  
        $insert_data = array();
        if(!empty($params['educations'])) { 
            foreach( $params['educations'] as $education ) {
                $insert_data[] = array(
                    "candidate_id" => $candidate_id,
                    "start_period" =>  $education['start_year'],
                    "end_period" => $education['end_year'],
                    "education_level" => $education['education_level'],
                    "institution_name" => $education['institution_name'],
                    "faculty" => $education['faculty'], 
                    "major" => $education['major'], 
                    "gpa" => $education['gpa'], 
                );
            }
            if( !empty($insert_data) ) {
                $affected = DB::table('candidate_educations')->insert($insert_data);
            }
            if( $affected === false ) {
                return response()->json(
                    [
                        'error' => 1,
                        'error_message' => 'ไม่สามารถแก้ไขได้ โปรดลองใหม่อีกครั้ง'
                    ], 
                    400 
                ); 
            } 
        } 
          
        return response()->json(
            [
                'error_code' => 0, 
            ], 
            200
        ); 
    }
    public function verify(Request $request, $id)
    { 
        $candidate = DB::table('candidates')
                        ->where('verify_key', $id )
                        ->where('status', 'pending') 
                        ->first();    
        if($candidate) {
            DB::table('candidates')  
                ->where('id',  $candidate->id)
                ->update([
                    'status' => 'active',
                    'verify_key' => null
                ]);
        } 
        return redirect('login');
    }
}