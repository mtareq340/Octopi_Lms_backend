<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('name' => 'شئون الطلاب'),
            array('name' => 'الأرشاد الأكاديمي'),
            array('name' => 'الموظفين'),
            array('name' => 'إعدادات النظام'),
        );
        
        DB::table('permission_groups')->insert($data);
                
    }
}
