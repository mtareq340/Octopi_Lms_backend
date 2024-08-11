<?php

namespace Modules\Academic\Imports;

use Modules\Academic\Entities\Course;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CourseImport implements ToModel
{

    public $failedUploadReason = [];
    public $rowNumber = 0;
    public $rowNumberCreated = 0;
    public $rowNumberUpdated = 0;
    public $rowNumberNotCreated = 0;


    public function model(array $row)
    {
        return $this->insertCourse($row);
    }

    public function insertCourse(array $row) {
        $user = null;
        $this->rowNumber++;

        $name = str_replace("", "", $row[0] ?? null);
        $code = str_replace(" ", "", $row[1] ?? null);
        $credit_hour = str_replace(" ", "", $row[2] ?? null);
      

        if(!is_null($code)){
            $course = Course::where('code',$code)->first() ?? null;
        }

        $messages = [
            '0.required' => 'الاسم مطلوب',
            '1.required' => 'الكود مطلوب',
            '1.unique' => 'الكود موجود من قبل',
            '2.required' => 'عدد ساعات المقرر مطلوب',
            '2.numeric' => 'عدد الساعات يجب ان تكون رقم',
        ];

        $validator = Validator::make($row, [
            '0' => 'required',
            '1' => ['required', Rule::unique('academic_courses', 'code')->ignore($course->id ?? 0)],
            '2' => 'required|numeric',
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
                'الكود' => $code,
                'عدد الساعات' => $credit_hour,
                'الأسباب' => $message,
            ];
            $this->rowNumberNotCreated++;
            return null;
        }
            // if course exist
        if($course){
            $course->update([
                'name' => $name,
                'code' => $code,
                'credit_hour' => $credit_hour
            ]);
            $this->rowNumberUpdated++;
        }else{ // if course not exist
            $course = Course::create([
                'name' => $name,
                'code' => $code,
                'credit_hour' => $credit_hour
            ]);
           
            $this->rowNumberCreated++;
        }


        return $course->refresh();
    }
}
