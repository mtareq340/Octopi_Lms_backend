<?php
namespace Modules\MainSetting\Http\Controllers;
use App\Http\Requests\MainSearch;
use Illuminate\Routing\Controller;
use Modules\MainSetting\Entities\Term;
use Modules\MainSetting\Http\Requests\TermRequest;
class TermController extends Controller
{
    public function index(MainSearch $request)
    {
        $offsetData = getOffsetData($request->pageNum, $request->perPage);
        $query = Term::query();
        if ($request->search_key) {
            $query->where('name', 'like', '%' . $request->search_key . '%');
        }
        $resources = $query->skip($offsetData)->take($request->perPage)->latest()->get();
        return responseJson(1, 'تم', $resources);
    }
    public function getTerms()
    {
        $resources = Term::select('id', 'name')->get();
        return responseJson(1, 'تم', $resources);
    }
    public function store(TermRequest $request)
    {
        $resource = Term::create($request->all());
        $resource = Term::find($resource->id);
        return responseJson(1, 'تم', $resource);
    }
    public function update(TermRequest $request, $id)
    {
        $resource = Term::find($id);
        if (!$resource)
            return responseJson(0, 'غير موجود', $resource);
        $resource->update($request->all());
        $resource = Term::find($id);
        return responseJson(1, 'تم', $resource);
    }
    public function destroy($id)
    {
        $resource = Term::find($id);
        if (!$resource)
            return responseJson(0, 'غير موجود', $resource);
        try {
            $resource->delete();
            return responseJson(1, 'تم', $resource);
        } catch (\Exception $e) {
            return responseJson(0, 'يجب مسح البيانات المعتمدة علي الفصل الدراسي أولا');
        }
    }
}
