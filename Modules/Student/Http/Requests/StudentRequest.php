<?php
namespace Modules\Student\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
class StudentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'=>'required',
            'phone'=>'numeric|nullable',
            'level_id'=>'required|integer',
            'division_id'=>'required|integer',
            'email'=>'email|nullable',
            'code'=>['required','integer',Rule::unique('students', 'code')->ignore($this->input('id') ?? 0)],
            'national_id'=>[
                'required',
                'integer',
                Rule::unique('students', 'national_id')->ignore($this->input('id') ?? 0),
            ],
        ];
    }
    public function messages(): array
    {
        return  [
            "name.required"=>'الأسم مطلوب',
            "code.required"=>'الكود مطلوب',
            "set_number.required"=>'رقم الجلوس مطلوب',
            "national_id.required"=>'الرقم القومي مطلوب',
            "level_id.required"=>'المستوي مطلوب',
            "division_id.required"=>'الشعبة مطلوبه',
            "code.unique"=>'الكود موجود من قبل',
            "code.integer"=>'الكود يجب ان يكون رقم',
            "phone.integer"=>'الهاتف خطأ',
            "set_number.integer"=>'رقم الجلوس يجب ان يكون رقم',
            "national_id.integer"=>'الرقم القومي يجب ان يكون رقم',
            "level_id.integer"=>'المستوي خطأ',
            "division_id.integer"=>'الشعبة خطأ',
            "email.email"=>'الإيميل خطأ',
            "national_id.unique"=>'الرقم القومي موجود من قبل',
            "set_number.unique"=>'رقم الجلوس موجود من قبل',
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
