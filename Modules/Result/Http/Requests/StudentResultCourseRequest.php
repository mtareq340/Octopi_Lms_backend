<?php

namespace Modules\Result\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;
class StudentResultCourseRequest extends FormRequest
{
    public function rules()
    {
        return [
            'mid_degree' => 'nullable|numeric',
            'work_year_degree' => 'nullable|numeric',
            'amly_degree' => 'nullable|numeric',
            'final_degree' => 'nullable|numeric',
            'total_degree' => 'nullable|numeric',
        ];
    }
    public function messages(): array{
        return [
            'mid_degree.numeric' => 'درجة الميد تيرم يجب ان تكون رقم',
            'work_year_degree.numeric' => 'درجة اعمال السنة يجب ان تكون رقم',
            'amly_degree.numeric' => 'درجة العملي يجب ان تكون رقم',
            'final_degree.numeric' => 'درجة الفاينل يجب ان تكون رقم',
            'total_degree.numeric' => 'درجة مجموع الدرجات يجب ان تكون رقم',
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
