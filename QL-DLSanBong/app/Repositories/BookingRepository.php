<?php

namespace App\Repositories;

use App\Models\BookingSchedule;
use Illuminate\Support\Str;

class BookingRepository
{
    protected $model;

    public function __construct(BookingSchedule $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
//        $data['id'] = (string) Str::uuid();
        return $this->model->create($data);
    }

    public function find($id)
    {
        return $this->model->with(['field'])->find($id);
    }

    public function findByUser($userId)
    {
        return $this->model->with(['field'])
            ->where('user_id', $userId)
            ->get();
    }

    public function findByFieldAndDate($fieldId, $dateStart, $dateEnd)
    {
        return $this->model->where('field_id', $fieldId)
            ->where(function ($query) use ($dateStart, $dateEnd) {
                $query->whereBetween('date_start', [$dateStart, $dateEnd])
                    ->orWhereBetween('date_end', [$dateStart, $dateEnd])
                    ->orWhere(function ($query) use ($dateStart, $dateEnd) {
                        $query->where('date_start', '<', $dateStart)
                            ->where('date_end', '>', $dateEnd);
                    });
            })->get();
    }

    public function delete($id)
    {
        return $this->model->where('id', $id)->delete();
    }
}
