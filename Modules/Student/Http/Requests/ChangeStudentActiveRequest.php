<?php

namespace Modules\Student\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class ChangeStudentActiveRequest extends FormRequest
{
    public function rules()
    {
        return [
            'active'=>'required|in:1,0',
        ];
    }
    public function messages(): array
    {
        return  [
            "active.required"=>'التفعيل مطلوب',
            "active.in"=>'التفعيل يجب ان يكون 1 او 0',
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
