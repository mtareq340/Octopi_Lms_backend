<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\ProfileRequest;
use Modules\Employee\Entities\Employee;
use Modules\Student\Entities\Student;
class ProfileController extends Controller
{
    public function update(ProfileRequest $request, $id)
    {
        $user = null;
        switch($request->role_id){
            case 1 :
                $user = Employee::where('id',$id)->select('user_id')->first();
                break;
        }
        if(!$user)
            return responseJson(0, 'هذا المستخدم غير موجود', $user);
        $user = User::find($user->user_id);
        if(Hash::check($request->current_password, $user->password)){
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);
            return responseJson(1, 'تم تعديل كلمة المررو بنجاح', $user);
        }else{
            return responseJson(0, 'كلمة المرور السابقة غير صحيحة', $user);
        }
    }
}
