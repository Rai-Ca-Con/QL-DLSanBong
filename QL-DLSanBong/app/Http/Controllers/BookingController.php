<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Http\Resources\BookingResource;
use App\Responses\APIResponse;
use App\Services\BookingService;
use App\Services\VNPayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class BookingController extends Controller
{
    protected $bookingService;
    protected $vnPayService;

    public function __construct(BookingService $bookingService, VNPayService $vnPayService)
    {
        $this->bookingService = $bookingService;
        $this->vnPayService = $vnPayService;
    }

    // Đặt sân
    public function store(BookingRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $result = $this->bookingService->create($data);

        return APIResponse::success([
            'booking' => new BookingResource($result['booking']),
            'payUrl' => $result['payUrl']
        ]);
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

    // Callback của VNPay (IPN)
    public function handleBookingPayment(Request $request)
    {
//        Log::info('VNPay Callback:', $request->all());
        $result = $this->vnPayService->handleCallback($request->all());
        return response()->json($request->all());
    }
}
