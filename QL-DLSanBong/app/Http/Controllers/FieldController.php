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
    protected $imageService;

    public function __construct(FieldService $fieldService, ImageService $imageService)
    {
        $this->fieldService = $fieldService;
        $this->imageService = $imageService;
    }

    // Lấy danh sách tất cả các sân bóng
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10); // Mặc định mỗi trang 10 field
        return APIResponse::success(FieldResource::collection($this->fieldService->paginate($perPage)));
        // Throw Ex fieldService->paginate
    }

    // Lấy chi tiết field và ảnh
    public function show($id)
    {
//        $field = $this->fieldService->findById($id);
//
//        if (!$field) {
//            return response()->json(['message' => 'Field not found'], 404);
//        }
        return APIResponse::success(new FieldResource($this->fieldService->findById($id)));

//        return response()->json($field);
    }

    // Tạo mới Field
    public function store(Request $request)
    {
        $data = $request->all();
        $field = $this->fieldService->create($data);

        // Upload ảnh nếu có
        if ($request->hasFile('image')) {
            $this->imageService->uploadImage($request, $field->id);
        }
        return APIResponse::success(new FieldResource($field));

//        return response()->json(['message' => 'Field created successfully', 'field' => $field], 201);
    }

    // Cập nhật Field
    public function update(Request $request, $id)
    {
        $this->fieldService->findById($id);
        $data = $request->all();
        $field = $this->fieldService->update($id, $data);

//        if (!$field) {
//            return response()->json(['message' => 'Field not found'], 404);
//        }

        // Nếu có ảnh mới thì xóa ảnh cũ rồi thêm ảnh mới
        if ($request->hasFile('image')) {
            $this->imageService->deleteByFieldId($id);
            $this->imageService->uploadImage($request, $id);
        }
        return APIResponse::success(new FieldResource($field));

//        return response()->json(['message' => 'Field updated successfully', 'field' => $field]);
    }

    // Xoá mềm một sân bóng
    public function destroy($id)
    {
        $this->fieldService->findById($id);
        $this->fieldService->delete($id);
        return response()->json(['message' => 'Field deleted successfully!']);
    }

    public function nearestFields(Request $request)
    {
        $lat = $request->input('latitude');
        $lng = $request->input('longitude');

        if (!$lat || !$lng) {
            return response()->json(['message' => 'Vui lòng cung cấp vị trí người dùng'], 422);
        }

        $fields = $this->fieldService->getFieldsSortedByDistance($lat, $lng);

        return response()->json($fields);
    }


}
