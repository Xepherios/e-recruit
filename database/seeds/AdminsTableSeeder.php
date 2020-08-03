<?php

use Illuminate\Database\Seeder;
 
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = "123456";
        for($i = 1; $i <= 5; $i++) {
            $status = "active";
            if($i % 2 == 0) {
                $status = "inactive";
            }
            DB::table('admins')->insert([
                'username' => "admin{$i}",
                'password' => Hash::make($password), 
                'status' => $status,
                'created_at' => date('Y-m-d H:i:s')
            ]); 
        } 
    }
}
