<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('name' => 'الطلاب', 'display_name' => 'students', 'group_id' => 1),
            array('name' => 'المواد الدراسية', 'display_name' => 'courses','group_id' => 1),
            array('name' => 'الموظفين', 'display_name' => 'pages','group_id' => 5),
            array('name' => 'اعدادات النظام', 'display_name' => 'pages','group_id' => 6),
        );
        
        DB::table('permission_models')->insert($data);
    }
}
