<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array( 'name' => 'الفصل الدراسي الأول'),
            array( 'name' => 'الفصل الدراسي الثاني'),
            array( 'name' => 'الفصل الدراسي الصيفي'),
        );
        
        DB::table('terms')->insert($data);
    }
}
