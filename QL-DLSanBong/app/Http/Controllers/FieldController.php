<?php

namespace App\Http\Controllers;

use App\Http\Resources\FieldResource;
use App\Responses\APIResponse;
use Illuminate\Http\Request;
use App\Services\FieldService;
use App\Services\ImageService;

class FieldController extends Controller
{
    protected $fieldService;


    public function __construct(FieldService $fieldService)
    {
        $this->fieldService = $fieldService;
    }


    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 12);
        return APIResponse::paginated(FieldResource::collection($this->fieldService->paginate($perPage)));
    }

    public function getFilteredFields(Request $request)
    {
        $lat = $request->input('latitude');
        $lng = $request->input('longitude');
        $perPage = $request->input('per_page', 12);

        if (!$lat || !$lng) {
            return response()->json(['message' => 'Vui lòng cung cấp vị trí người dùng'], 422);
        }

        return APIResponse::paginated(FieldResource::collection($this->fieldService->getFilteredFields($request, $perPage)));
    }

    public function show($id)
    {
        return APIResponse::success(new FieldResource($this->fieldService->findById($id)));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $field = $this->fieldService->create($data, $request);

        return APIResponse::success(new FieldResource($field));
    }

    public function update(Request $request, $id)
    {
        $this->fieldService->findById($id);
        $data = $request->all();
        $field = $this->fieldService->update($id, $data, $request);

        return APIResponse::success(new FieldResource($field));
    }

    public function destroy($id)
    {
        $this->fieldService->findById($id);
        $this->fieldService->delete($id);
        return response()->json(['message' => 'Field deleted successfully!']);
    }
}
