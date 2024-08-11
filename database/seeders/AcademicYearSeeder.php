<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array( 'name' => '2022/2023', 'start_date' => date("Y-m-d"), 'end_date' => date("Y-m-d"),'active' => 1),
        );
        
        DB::table('academic_years')->insert($data);
    }
}
