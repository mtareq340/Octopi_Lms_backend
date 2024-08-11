<?php

namespace Modules\Academic\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Modules\MainSetting\Entities\MainSetting;

class StudentRegisterCourseRequest extends FormRequest
{
    private $year;
    private $term;
    
    public function rules()
    {
        $this->year = MainSetting::getCurrentAcademicYear();
        $this->term = MainSetting::getCurrentAcademicTerm();
        return [
            'student_id' => "required|numeric",
        ];
    }
    public function messages(): array{
        return [
            'student_id.required'=> 'الطالب مطلوب',
            'student_id.numeric'=> 'خطأ بالطالب',
           
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['message' => $validator->errors()->first()], Response::HTTP_OK)
        );
    }
    protected function response(array $errors)
    {
        throw new HttpResponseException(
            response()->json(['message' => $errors], Response::HTTP_OK)
        );
    }
    public function authorize()
    {
        return true;
    }
}
