<?php
namespace Modules\Academic\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\MainSearch;
use Modules\Academic\Entities\Course;
use Modules\MainSetting\Entities\Level;
use Modules\MainSetting\Entities\Division;
use Modules\MainSetting\Entities\Term;
use Modules\Academic\Http\Requests\CourseRequest;
use Modules\Academic\Http\Requests\CourseGetRequest;
class CourseController extends Controller
{
    public function index(MainSearch $request)
    {
        $offsetData = getOffsetData($request->pageNum, $request->perPage);
        $query = Course::query();
        if($request->search_key){
            $query->where(function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->search_key.'%')
                ->orWhere('code', 'Like', '%'.$request->search_key.'%');
            });
        }
        $resources = $query->skip($offsetData)->take($request->perPage)->latest()->get();
        return responseJson(1, 'تم', $resources);
    }
    public function getCourses(){
        $resources = Course::select('id','name','code')->latest()->get();
        return responseJson(1, 'تم', $resources);
    }
    
    public function store(CourseRequest $request)
    {
        $resource = Course::create($request->all());

        return responseJson(1, 'تم الأضافة بنجاح', $resource);
    }
    public function update(CourseRequest $request, $id)
    {
        $resource = Course::find($id);
        if($resource)
            $resource->update($request->all());
        else
            return responseJson(0, 'غير موجود', $resource);
        return responseJson(1, 'تم التعديل بنجاح', $resource);
    }
    public function destroy($id)
    {
        $resource = Course::find($id);
        if($resource) {
            try {
                $resource->delete();
                return responseJson(1, 'تم الحذف بنجاح', $resource);
            } catch (\Exception $e) {
                return responseJson(0, 'لا يُمكن مسحه بسبب وجود بيانات خاصة به');
            }
        } else
            return responseJson(0, 'غير موجود', $resource);
    }
}
