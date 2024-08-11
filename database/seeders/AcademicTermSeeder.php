<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class AcademicTermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array( 'name' => 'الفصل الدراسي الاول', 'academic_year_id' => 1, 'start_date' => date("Y-m-d"), 'end_date' => date("Y-m-d"),'active' => 1),
        );
        
        DB::table('academic_terms')->insert($data);
    }
}
