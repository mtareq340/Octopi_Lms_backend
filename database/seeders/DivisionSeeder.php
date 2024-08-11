<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('name' => 'ادارة اعمال', 'level_id' => 1),
            array('name' => 'محاسبة', 'level_id' => 1),
            array('name' => 'نظم معلومات', 'level_id' => 1),

        );
        
        DB::table('divisions')->insert($data);
    }
}
