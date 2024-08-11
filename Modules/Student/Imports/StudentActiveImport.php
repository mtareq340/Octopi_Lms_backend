<?php
namespace Modules\Student\Imports;
use Maatwebsite\Excel\Concerns\ToModel;
use Modules\Student\Entities\Student;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
class StudentActiveImport implements ToModel
{
    public $failedUploadReason = [];
    public $rowNumber = 0;
    public $rowNumberUpdated = 0;
    public $rowNumberNotUpdated = 0;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function model(array $row)
    {
        return $this->insertStudentActive($row);
    }
    public function insertStudentActive(array $row) {
        $user = null;
        $this->rowNumber++;
        $code = str_replace(" ", "", $row[0] ?? null);
        if(!is_null($code)){
            $student = Student::where('code',$code)->select('user_id')->first() ?? null;
        }
        $messages = [
            '0.required' => 'الكود مطلوب',
        ];
        $validator = Validator::make($row, [
            '0' => 'required',
        ],$messages);
        if ($validator->fails()) {
            $message = '';
            foreach ($validator->errors()->messages() as $field => $errors) {
                foreach ($errors as $error) {
                    $message .= '  ' .$error. '  --  ';
                }
            }
            $this->failedUploadReason[] = [
                'الكود' => $code,
                'الأسباب' => $message,
            ];
            $this->rowNumberNotUpdated++;
            return null;
        }
        if($student){
            $user = User::find($student->user_id);
            if($user){
                $user->update([
                    'active' => $this->request->active
                ]);
            }
            $this->rowNumberUpdated++;
        }else{ // if student not exist
                $this->failedUploadReason[] = [
                    'الكود' => $code,
                    'الأسباب' => 'هذا الكود غير موجود',
                ];
                $this->rowNumberNotUpdated++;
                return null;
        }
        return $student;
    }
}
