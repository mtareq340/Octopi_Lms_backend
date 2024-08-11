<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        $data = array(
            array('name' => 'admin', 'username' => 'admin', 'email' => 'admin@admin.com', 'password' => Hash::make('123456'), 'category_id' => 3, 'role_id' => 1),
        );
        
        DB::table('users')->insert($data);
    }
}
