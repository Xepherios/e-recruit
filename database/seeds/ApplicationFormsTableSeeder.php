<?php

use Illuminate\Database\Seeder;
 
use Illuminate\Support\Facades\Hash;

class ApplicationFormsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
        for($i = 1; $i <= 5; $i++) {   
            $data = [
                'candidate_id' => $i,
                'job_id' => $i,
                'submitted_datetime' => date("Y-m-d H:i:s"),
                'status' => 'pending'
            ];
            if($i%2 == 0) {
                $data['status'] = "appointed_for_interview";
                $data['interview_datetime'] =  date("Y-m-d H:i:s", strtotime("+1 hour"));
            }
            DB::table('application_forms')->insert($data);  
        } 
        
    }
}
