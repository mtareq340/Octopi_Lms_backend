<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Modules\Student\Entities\Student;
use Modules\Employee\Entities\Employee;
use Modules\MainSetting\Entities\MainSetting;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\CheckApiTokenRequest;
use App\Http\Requests\CheckApiTokenPermissionRequest;
use App\Models\Role;
use Tymon\JWTAuth\Facades\JWTAuth;
class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $data = null;
        $credentials = $request->only('username', 'password');
        $token = Auth::attempt($credentials);
        if (!$token) {
            return responseJson(0, 'خطأ في البيانات');
        }
        $user = Auth::user();
        if(!$user->active){
            return responseJson(0, 'غير مسموح لك بالدخول');
        }
        $user->api_token = $token;
        $user->update();
        switch($user->role_id){
            case 1 :
                $userObject = Employee::where('user_id',$user->id)->select('id')->first();
                break;
        }
        $role = Role::select('name','id')->where('id',$user->role_id)->first();
        $year = MainSetting::getCurrentAcademicYear();
        $term = MainSetting::getCurrentAcademicTerm();
        $data['id'] = $userObject->id ?? null;
        $data['name'] = $user->name;
        if($user->role_id==3){$data['division_id'] = $userObject->division_id ?? null;}
        $data['api_token'] = $user->api_token;
        $data['academic_year_id'] = $year->id ?? null;
        $data['academic_term_id'] = $term->id ?? null;
        $data['permissions'] = $user->permissions;
        $data['role_name'] = $role->name;
        $data['role_id'] = $role->id;
        return responseJson(1, 'تم التسجيل بنجاح', $data);
    }
    public function logout(Request $request)
    {
        $user = User::where('api_token', $request->api_token)->first();
        $user->update(['api_token' => null ]);
        return responseJson(1, 'تم ', $user);
    }
    public function refresh()
    {
        return response()->json([
            'status' => 'تم بنجاح تجديد ال token',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
    public function checkApiToken(CheckApiTokenRequest $request){
        $token = $request->api_token;
        $user = null;
        if($token)
            $user = User::where('api_token', $token)->first();
        if(isset($user))
            return responseJson(1, 'تم التسجيل بنجاح', $user);
            return responseJson(0, 'كود الأمان غير موجود');
    }

    public function checkApiTokenPermission(CheckApiTokenPermissionRequest $request){
        $token = $request->api_token;
        $permissionName = $request->permission;
        $user = null;
        $user = User::where('api_token', $token)->first();
        if(in_array($permissionName, $user->permissions))
            return responseJson(1, 'هذا المستخدم لدية الصلاحية', $user->permissions);
        else{
            $tokenNew = JWTAuth::fromUser($user);
            $user->update(['api_token' => $tokenNew]);
            return responseJson(0, 'هذا المستخدم ليس لدية');
        }
    }
}
