<?php

use Illuminate\Database\Seeder;
 
use Illuminate\Support\Facades\Hash;

class CandidatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  Fake Data
        $names = array("สมชาย", "สมศักดิ์", "สมภพ", "สมศรี", "สมทรง");
        $surnames = array("สายประจำ", "ปักธงชาติ", "ตบกระจาย", "ดีเสมอ", "ดงป่าไผ่");
        $military_statuses = array("exempt", "discharge", "military_studied");
        $positions = array("พนักงานส่งของ", "นักบินอวกาศ", "นักกีฬาแบดมินตัน", "นักการเมือง", "พนักงานดูแลหมีแพนด้า");
        $password = "123456";
        $status = "active";
        $pid = array('3-4321-13868-30-1', '4-9208-07604-04-1', '6-1332-67879-97-1', '9-9951-81398-98-2', '5-1469-48144-65-9' ,'7-2827-66498-84-8');
        //

        
        for($i = 1; $i <= 5; $i++) { 
            $gender = "M";
            if($i==3) {
                $gender = "F";
            }
            $military_status = $military_statuses[($i%2)];
            DB::table('candidates')->insert([
                'identification_number' => $pid[$i],
                'email' => "thanadon.songsuittipong+{$i}@g.swu.ac.th",
                'password' => Hash::make($password), 
                'first_name' =>  $names[$i-1],
                'last_name' => $surnames[$i-1],
                'phone_number' => "02-000-0000",
                'date_of_birth' => date('Y-m-d'),
                'gender' => $gender,
                'nationality' => 'ไทย',
                'race' => 'ไทย',
                'military_status' => $military_status,
                'status' => $status,
                'created_at' => date('Y-m-d H:i:s')
            ]); 

            DB::table('candidate_educations')->insert([
                'candidate_id' => $i, 
                'education_level' => 'bachelor', 
                'start_period' => 2012,
                'end_period' => 2015,
                'institution_name' => "มหาวิทยาลัยศรึนครินทรวิโรฒ",
                'faculty' => "วิทยาศาสตร์",
                'major' => "วิทยาการข้อมูล",
                'gpa' => 3.5 
            ]); 
            DB::table('candidate_experiences')->insert([
                'candidate_id' => $i,  
                'start_period' => 2015,
                'end_period' => 2017,
                'organization_name' => "Company " . chr( ($i-1) + 65 ) ,
                'position' => $positions[$i-1]
            ]); 
 
        } 
        
    }
}
