<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;
class CheckApiTokenPermissionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'api_token' => "required|string"
        ];
    }
    public function messages(): array{
        return [
            'api_token.required' => ' الرمز مطلوب',
            'api_token.string' => ' الرمز يجب ان بكون حروف وارقام'
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
