<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('name' => 'المستوي الأول'),
            array('name' => 'المستوي الثاني'),
            array('name' => 'المستوي الثالث'),
            array('name' => 'المستوي الرابع '),
            array('name' => 'الخريجين'),
        );
        
        DB::table('levels')->insert($data);
    }
}
