<?php

namespace Modules\Student\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Modules\Student\Entities\Student;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Modules\MainSetting\Entities\MainSetting;
use Modules\Student\Entities\StudentDivision;
use Modules\Student\Entities\StudentLevel;
use Modules\Student\Entities\StudentRegulation;
use Modules\Student\Entities\StudentSetNumber;

class StudentImport implements ToModel
{

    public $failedUploadReason = [];
    public $rowNumber = 0;
    public $rowNumberCreated = 0;
    public $rowNumberUpdated = 0;
    public $rowNumberNotCreated = 0;


    public function model(array $row)
    {
        return $this->insertStudent($row);
    }

    public function insertStudent(array $row) {
        $year = MainSetting::getCurrentAcademicYear();
        $term = MainSetting::getCurrentAcademicTerm();
        $user = null;
        $this->rowNumber++;

        $name = str_replace("", "", $row[0] ?? null);
        $username = str_replace("", "", $row[1] ?? null);
        $password = str_replace("", "", $row[2] ?? null);
        $address = str_replace("", "", $row[3] ?? null);
        $code = str_replace(" ", "", $row[4] ?? null);
        $set_number = str_replace(" ", "", $row[5] ?? null);
        $national_id = str_replace(" ", "", $row[6] ?? null);
        $level_id = str_replace(" ", "", $row[7] ?? null);
        $division_id = str_replace(" ", "", $row[8] ?? null);
        $email = $row[9] ?? null;
        $phone = str_replace(" ", "", $row[10] ?? null);


        if(!is_null($username)){
            $user = User::where('username',$username)->first() ?? null;
        }
        if(!is_null($code)){
            $student = Student::where('code',$code)->first() ?? null;
        }
        $messages = [
            '0.required' => 'الاسم مطلوب',
            '1.required' => 'اسم المستخدم مطلوب',
            '1.unique' => 'اسم المستخدم موجود من قبل',
            '2.required' => ' كلمة السر مطلوب',
            '4.required' => 'الكود مطلوب',
            '4.unique' => 'الكود موجود من قبل',
            '5.numeric' => 'رقم الجلوس يجب ان يكون رقم',
            '5.unique' => 'رقم الجلوس  موجود من قبل',
            '6.required' => 'الرقم القومي مطلوب',
            '6.unique' => 'الرقم القومي موجود من قبل',
            '7.required' => 'المستوي مطلوب',
            '7.exists' => 'المستوي غير موجود',
            '7.numeric' => 'المستوي يجب ان يكون رقم',
            '8.required' => 'التخصص مطلوب',
            '8.exists' => 'التخصص غير موجود',
            '8.numeric' => 'التخصص يجب ان يكون رقم',
            '9.unique' => 'البريد الالكتروني موجود من قبل',
        ];

        $validator = Validator::make($row, [
            '0' => 'required',
            '1' => ['required', Rule::unique('users', 'username')->ignore($user->id ?? 0)],
            '2' => 'required',
            '3' => 'nullable',
            '4' => ['required', Rule::unique('students', 'code')->ignore($student->id ?? 0)],
            '5' => ['required', Rule::unique('students', 'set_number')->ignore($student->id ?? 0)],
            '6' =>['required', Rule::unique('students', 'national_id')->ignore($student->id ?? 0)],
            '7' => ['required', 'numeric','exists:levels,id'],
            '8' => ['required', 'numeric','exists:divisions,id'],
            '9' => ['nullable',Rule::unique('users', 'email')->ignore($user->id ?? 0)],

        ],$messages);


        if ($validator->fails()) {
            $message = '';
            foreach ($validator->errors()->messages() as $field => $errors) {
                foreach ($errors as $error) {
                    $message .= '  ' .$error. '  --  ';
                }
            }
            $this->failedUploadReason[] = [
                'الأسم' => $name,
                'اسم المستخدم ' => $username,
                'كلمة السر' => $password,
                'العنوان' => $address,
                'الكود' => $code,
                'رقم الجلوس' => $set_number,
                'الرقم القومي' => $national_id,
                'المستوي' => $level_id,
                'التخصص' => $division_id,
                'البريد الالكتروني' => $email,
                'الموبيل' => $phone,
                'الأسباب' => $message,
            ];
            $this->rowNumberNotCreated++;
            return null;
        }


        if($student){
            $user = User::find($student->user_id);
            if($user){
                $user->update([
                    'name' => $name,
                    'username' => $username,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'category_id' => 1,
                    'role_id' => 3
                ]);
            }else{
                $user = User::create([
                    'name' => $name,
                    'username' => $username,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'category_id' => 1,
                    'role_id' => 3
                ]);
            }
            $student->update([
                "user_id" => $user->id,
                "name" => $name,
                'code' => $code,
                'address' => $address,
                'set_number' => $set_number,
                'national_id' => $national_id,
                'level_id' => $level_id,
                'division_id' => $division_id,
                'email' => $email,
                'phone' => $phone,
                'writen_by'=> $user->id,
                'academic_year_id'=>$year->id,
                'academic_term_id'=>$term->id,
                'regulation_id'=>1,
                "active" => 1
            ]);
            $this->rowNumberUpdated++;
        }else{ // if student not exist
            if($user){
                $this->failedUploadReason[] = [
                    'الأسم' => $name,
                    'اسم المستخدم ' => $username,
                    'كلمة السر' => $password,
                    'العنوان' => $address,
                    'الكود' => $code,
                    'رقم الجلوس' => $set_number,
                    'الرقم القومي' => $national_id,
                    'المستوي' => $level_id,
                    'التخصص' => $division_id,
                    'البريد الالكتروني' => $email,
                    'الموبيل' => $phone,
                    'الأسباب' => 'المستخدم موجود من قبل',
                ];
                $this->rowNumberNotCreated++;
                return null;
            }else{
                $user = User::create([
                    'name' => $name,
                    'username' => $username,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'category_id' => 1,
                    'role_id' => 3
                ]);
            }
            $student = Student::create([
                "user_id" => $user->id,
                "name" => $name,
                'password' => Hash::make($password),
                'code' => $code,
                'address' => $address,
                'set_number' => $set_number,
                'national_id' => $national_id,
                'level_id' => $level_id,
                'division_id' => $division_id,
                'email' => $email,
                'phone' => $phone,
                'writen_by'=> $user->id,
                'academic_year_id'=>$year->id,
                'academic_term_id'=>$term->id,
                'regulation_id'=>1,
                "active" => 1
            ]);
            StudentDivision::insert([
                'student_id'=>$student->id,
                'division_id'=>$division_id,
                'academic_year_id'=>$year->id,
                'academic_term_id'=>$term->id
            ]);
            StudentLevel::insert([
                'student_id'=>$student->id,
                'level_id'=>$level_id,
                'academic_year_id'=>$year->id,
                'academic_term_id'=>$term->id
            ]);
            StudentSetNumber::insert([
                'student_id'=>$student->id,
                'set_number'=>$set_number,
                'academic_year_id'=>$year->id,
                'academic_term_id'=>$term->id
            ]);
            StudentRegulation::insert([
                'student_id'=>$student->id,
                'regulation_id'=>1,
                'academic_year_id'=>$year->id,
                'academic_term_id'=>$term->id
            ]);
            $this->rowNumberCreated++;
        }
        return $student;
    }
}
