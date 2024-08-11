<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;
class MainSearch extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'pageNum' => "required",
            'perPage' => "required"
        ];
    }
    public function messages(): array
    {
        return  [
            "pageNum.required"=>'حقل رقم الصفحة مطلوب',
            "perPage.required"=>'حقل عدد الداتا مطلوب'
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
}
