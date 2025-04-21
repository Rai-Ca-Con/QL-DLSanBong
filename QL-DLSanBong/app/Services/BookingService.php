<?php

namespace App\Services;

use App\Http\Resources\BookingResource;
use App\Repositories\BookingRepository;
use App\Repositories\ReceiptRepository;
use Illuminate\Support\Str;
use App\Exceptions\AppException;
use App\Enums\ErrorCode;
use Carbon\Carbon;

class BookingService
{
    protected $bookingRepository;
    protected $receiptRepository;

    public function __construct(BookingRepository $bookingRepository, ReceiptRepository $receiptRepository)
    {
        $this->bookingRepository = $bookingRepository;
        $this->receiptRepository = $receiptRepository;
    }

    public function isAvailable($fieldId, $dateStart, $dateEnd): bool
    {
        return $this->bookingRepository->findByFieldAndDate($fieldId, $dateStart, $dateEnd)->isEmpty();
    }

    public function create(array $data)
    {
        $available = $this->isAvailable($data['field_id'], $data['date_start'], $data['date_end']);

        if (!$available) {
            throw new AppException(ErrorCode::BOOKING_CONFLICT);
        }

        $bookingId = Str::uuid()->toString();
        $data['id'] = $bookingId;

        // Tạo lịch đặt sân
        $booking = $this->bookingRepository->create($data);

        // Tính tiền thuê (giả sử 100k/h)
        $hours = Carbon::parse($data['date_start'])->floatDiffInHours(Carbon::parse($data['date_end'])); // Convert to hours
        $pricePerHour = 100000;
        $totalPrice = $hours * $pricePerHour;

        // Tạo hóa đơn
        $receipt = $this->receiptRepository->create([
            'user_id'     => $data['user_id'],
            'booking_id'  => $bookingId,
            'date'        => now(),
            'total_price' => $totalPrice,
            'status'      => 'pending',
        ]);

        // 5. Gọi MomoService để tạo thanh toán
        $momoService = new MomoService();
        $momoResponse = $momoService->createPayment($totalPrice, $receipt->id);

        // 5. Gọi VNPayService để tạo thanh toán
        $vnpayService = new VNPayService($this->receiptRepository, $this->bookingRepository);
        $payUrl = $vnpayService->createPaymentUrl($receipt);

        return [
            'booking' => $booking,
            'payUrl' => $payUrl
        ];

    }

    public function findById($id)
    {
        $booking = $this->bookingRepository->find($id);

        if (!$booking) {
            throw new AppException(ErrorCode::BOOKING_NOT_FOUND);
        }
        return $booking;
    }

    public function getByUserId($userId)
    {
        return $this->bookingRepository->findByUser($userId);
    }

    public function cancel($id, $userId)
    {
        $booking = $this->bookingRepository->find($id);

        if (!$booking) {
            throw new AppException(ErrorCode::BOOKING_NOT_FOUND);
        }

        // Kiểm tra người dùng hiện tại có quyền huỷ lịch này không
        if ($booking->user_id != $userId) {
            throw new AppException(ErrorCode::UNAUTHORIZED_ACTION);
        }

        // Cập nhật trạng thái hóa đơn liên quan (nếu có)
        $receipt = $this->receiptRepository->findByBookingId($id);
        if ($receipt) {
            $this->receiptRepository->updateStatus($receipt->id, 'cancelled');
        }

        return $this->bookingRepository->delete($id);
    }
}
