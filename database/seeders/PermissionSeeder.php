<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('name' => 'Academic', 'display_name' => 'الأرشاد الأكاديمي', 'model_id' => null),
            array('name' => 'show_courses', 'display_name' => 'عرض المقررات الدراسية', 'model_id' => 3),
            array('name' => 'add_courses', 'display_name' => 'اضافة مقرر دراسي', 'model_id' => 3),
            array('name' => 'delete_courses', 'display_name' => 'حذف مقرر دراسي', 'model_id' => 3),
            array('name' => 'update_courses', 'display_name' => 'تعديل مقرر دراسي', 'model_id' => 3),
            array('name' => 'print_courses', 'display_name' => 'طباعة مقرر دراسي', 'model_id' => 3),
            
            array('name' => 'show_students', 'display_name' => 'عرض الطلاب', 'model_id' => 1),
            array('name' => 'add_students', 'display_name' => 'اضافة طالب', 'model_id' => 1),
            array('name' => 'delete_students', 'display_name' => 'حذف طالب', 'model_id' => 1),
            array('name' => 'update_students', 'display_name' => 'تعديل طالب', 'model_id' => 1),
            array('name' => 'print_students', 'display_name' => 'طباعة الطلاب', 'model_id' => 1),
           
            array('name' => 'print_studentsRegisterCourses', 'display_name' => 'طباعة تسجيلات الطلاب ', 'model_id' => 2),
            array('name' => 'update_studentsRegisterCourses', 'display_name' => 'تعديل تسجيلات الطلاب ', 'model_id' => 2),
            array('name' => 'delete_studentsRegisterCourses', 'display_name' => 'حذف تسجيلات الطلاب ', 'model_id' => 2),
            array('name' => 'add_studentsRegisterCourses', 'display_name' => 'اضافة تسجيلات الطلاب ', 'model_id' => 2),
            array('name' => 'show_studentsRegisterCourses', 'display_name' => 'عرض تسجيلات الطلاب ', 'model_id' => 2),
           
            array('name' => 'show_studentCourses', 'display_name' => 'عرض مقررات الطلاب ', 'model_id' => 1),
            array('name' => 'print_studentCourses', 'display_name' => 'طباعة مقررات الطلاب ', 'model_id' => 1),
           
            array('name' => 'student_affairs', 'display_name' => ' شئون الطلاب ', 'model_id' => null),
            array('name' => 'Employee', 'display_name' => ' الموظفين ', 'model_id' => null),
            array('name' => 'ProfileSetting', 'display_name' => 'اعدادات الحساب', 'model_id' => null),
            array('name' => 'MainSetting', 'display_name' => ' الاعدادات الرئيسية ', 'model_id' => null),
            array('name' => 'show_divisions', 'display_name' => 'عرض التخصصات', 'model_id' => 7),
            array('name' => 'update_divisions', 'display_name' => 'تعديل التخصصات', 'model_id' => 7),
            array('name' => 'delete_divisions', 'display_name' => 'مسح التخصصات', 'model_id' => 7),
            array('name' => 'add_divisions', 'display_name' => 'اضافة التخصصات', 'model_id' => 7),
            array('name' => 'print_divisions', 'display_name' => 'طباعة التخصصات', 'model_id' => 7),

        );

        DB::table('permissions')->insert($data);
    }
}
