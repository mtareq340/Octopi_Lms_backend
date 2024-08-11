<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    
        $this->call(PermissionGroupSeeder::class);
        $this->call(PermissionModelSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(DivisionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PermissionRoleSeeder::class);
        $this->call(AcademicYearSeeder::class);
        $this->call(AcademicTermSeeder::class);
        $this->call(CourseSeeder::class);
        
     

        // \App\Models\User::factory(10)->create();
    }
}
