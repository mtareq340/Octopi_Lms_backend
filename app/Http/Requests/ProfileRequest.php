<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;
class ProfileRequest extends FormRequest
{
    public function rules()
    {
        return [
            'current_password' => "required",
            'new_password' => "required",
        ];
    }
    public function messages(): array{
        return [
            'current_password.required' => 'كلمة السر الحالية مطلوبة',
            'new_password.required' => 'كلمة السر الجديدة مطلوبة'
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
