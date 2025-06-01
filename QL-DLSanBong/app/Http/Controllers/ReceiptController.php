<?php

namespace App\Http\Controllers;

use App\Services\ReceiptService;

class ReceiptController extends Controller
{
    protected $receiptService;

    public function __construct(ReceiptService $receiptService)
    {
        $this->receiptService = $receiptService;
    }

    public function confirmFullPayment(string $id)
    {
        $this->receiptService->confirmFullPayment($id);

        return response()->json(['message' => 'Đã xác nhận thanh toán đủ thành công']);
    }


}
