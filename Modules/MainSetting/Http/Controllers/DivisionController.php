<?php

namespace Modules\MainSetting\Http\Controllers;
use App\Http\Requests\MainSearch;
use Illuminate\Routing\Controller;
use Modules\MainSetting\Entities\Division;
use Modules\MainSetting\Http\Requests\DivisionStoreRequest;
class DivisionController extends Controller
{
    public function index(MainSearch $request)
    {
        $offsetData = getOffsetData($request->pageNum, $request->perPage);
        $query = Division::query();
        if ($request->search_key) {
            $query->where('name', 'like', '%' . $request->search_key . '%');
        }
        $resources = $query->skip($offsetData)->take($request->perPage)->latest()->get();
        return responseJson(1, 'تم', $resources);
    }
    public function getDivisions()
    {
        $resources = Division::select('id', 'name')->get();
        return responseJson(1, 'تم', $resources);
    }
    public function store(DivisionStoreRequest $request)
    {
        $resource = Division::create($request->all());
        $resource = Division::find($resource->id);
        return responseJson(1, 'تم', $resource);
    }
    public function update(DivisionStoreRequest $request, $id)
    {
        $resource = Division::find($id);
        if (!$resource)
            return responseJson(0, 'غير موجود', $resource);

        $resource->update($request->all());
        $resource = Division::find($id);
        return responseJson(1, 'تم', $resource);
    }
    public function destroy($id)
    {
        $resource = Division::find($id);
        if (!$resource)
            return responseJson(0, 'غير موجود', $resource);

        try {
            $resource->delete();
            return responseJson(1, 'تم', $resource);
        } catch (\Exception $e) {
            return responseJson(0, 'يجب مسح البيانات المعتمدة علي الشعبة أولا');
        }
    }
}
