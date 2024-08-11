<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = DB::table('permissions')->get();
        foreach($permissions as $permission){
            DB::table('permission_role')->insert(['role_id' => 1, 'permission_id' => $permission->id]);
        }
        
    }
}
