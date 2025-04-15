<?php

namespace App\Repositories;

use App\Models\Receipt;
use Illuminate\Support\Str;

class ReceiptRepository
{
    protected $model;

    public function __construct(Receipt $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        $data['id'] = Str::uuid()->toString();
        return $this->model->create($data);
    }

    public function updateStatus($id, $status)
    {
        return $this->model->where('id', $id)->update(['status' => $status]);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findByBookingId($bookingId)
    {
        return $this->model->where('booking_id', $bookingId)->first();
    }
}
