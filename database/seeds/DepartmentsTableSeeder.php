<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 
        $departments = array("Marketing", "Content", "Sales", "Accounting", "Development", "Internship");
        foreach($departments as $department) {
            DB::table('departments')->insert([
                'name' => $department,
                'status' => 'active', 
                'created_at' => date('Y-m-d H:i:s')
            ]); 
        } 
    }
}
