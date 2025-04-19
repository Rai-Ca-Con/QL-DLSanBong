<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReceiptResource;
use App\Responses\APIResponse;
use App\Services\ReceiptService;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    protected $receiptService;

    public function __construct(ReceiptService $receiptService)
    {
        $this->receiptService = $receiptService;
    }

    public function revenueByField(Request $request)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        if (!$start || !$end) {
            return response()->json(['message' => 'Vui lòng cung cấp start_date và end_date'], 422);
        }

        $revenues = $this->receiptService->getRevenueByFieldInRange($start, $end);
        return APIResponse::success(ReceiptResource::collection($this->receiptService->getRevenueByFieldInRange($start, $end)));

//        return response()->json($revenues);
//        return APIResponse::success(FieldResource::collection($this->fieldService->paginate($perPage)));
    }
}
