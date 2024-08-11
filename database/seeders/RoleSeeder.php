<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('name' => 'المسئول', 'display_name' => 'Super Admin', 'description' => 'Super Admin'),
            array('name' => 'دكتور', 'display_name' => 'Doctor', 'description' => 'Doctor'),
            array('name' => 'طالب', 'display_name' => 'Student', 'description' => 'Doctor'),
        );
        
        DB::table('roles')->insert($data);
    }
}
