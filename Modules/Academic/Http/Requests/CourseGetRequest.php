<?php
namespace Modules\Academic\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;
class CourseGetRequest extends FormRequest
{
    public function rules()
    {
        return [
            'division_id' => "required|numeric|exists:divisions,id",
        ];
    }
    public function messages(): array{
        return [
            'division_id.required' => 'الشعبة مطلوبة',
            'division_id.numeric' => 'خطأ بالشعبة',
            'division_id.exists' => 'الشعبة غير موجودة'
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
