<?php

namespace Modules\Student\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class DefaultRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id'=>'required|exists:students,id',
            'division_id'=>'required|exists:divisions,id',
        ];
    }
    public function messages(): array
    {
        return  [
            "user_id.required"=>'المستخدم مطلوب',
            "user_id.exists"=>'المستخدم غير موجود',
            "division_id.required"=>'الشعبة مطلوب',
            "division_id.exists"=>'الشعبة غير موجود',
            'academic_year_id.required' => 'السنة الحالية مطلوب',
            'academic_term_id.required' => 'الفصل الدراسي مطلوب',
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

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
