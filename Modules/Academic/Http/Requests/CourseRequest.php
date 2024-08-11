<?php

namespace Modules\Academic\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class CourseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => "required",
            'code' => [
                'required',
                Rule::unique('academic_courses','code')->ignore($this->input('id')??0)
            ],
            'credit_hour' => "required|numeric",
        ];
    }
    public function messages(): array{
        return [
            'name.required'=> 'أسم المقرر مطلوب',
            'code.required'=>'كود المقرر مطلوب',
            'code.unique'=>'كود المقرر موجود من قبل',
            'credit_hour.required'=>'عدد ساعات المقرر مطلوبه',
            'credit_hour.numeric'=>'عدد ساعات المقرر غير صالحة'
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
