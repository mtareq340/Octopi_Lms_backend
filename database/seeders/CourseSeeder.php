<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('name' => 'مبادي القانون', 'code' => '00000000000', 'credit_hour' => 3),
            array('name' => ' المحاسبة المالية', 'code' => '111111111', 'credit_hour' => 3),
            array('name' => ' تكنولوجيا المعلومات', 'code' => '222222222', 'credit_hour' => 3),
        );
        
        DB::table('academic_courses')->insert($data);
    }
}
