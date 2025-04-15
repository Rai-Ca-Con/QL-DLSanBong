<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookingResource;
use App\Responses\APIResponse;
use App\Services\BookingService;
use Illuminate\Http\Request;


class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    // Đặt sân
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->id();
        return APIResponse::success(new BookingResource($this->bookingService->create($data)));
    }

    // Huỷ đặt sân
    public function cancel($id)
    {
        $userId = auth()->id();
        $this->bookingService->cancel($id, $userId);
        return response()->json(['message' => 'Booking cancelled successfully']);
    }

    // Lấy danh sách đặt sân theo user (tuỳ chọn)
    public function userBookings()
    {
        $userId = auth()->id();
        return APIResponse::success(BookingResource::collection($this->bookingService->getByUserId($userId)));
    }
}
