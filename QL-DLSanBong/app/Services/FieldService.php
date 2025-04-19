<?php

namespace App\Services;

use App\Enums\ErrorCode;
use App\Exceptions\AppException;
use App\Repositories\FieldRepository;;
use GuzzleHttp\Client;

class FieldService
{
    protected $repository;

    public function __construct(FieldRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
//        throw new AppException(ErrorCode::UNCATEGORIZED_EXCEPTION);

        return $this->repository->getAll();
    }

    public function paginate($perPage = 10)
    {
        return $this->repository->paginate($perPage);
    }

    public function findById($id)
    {
//        $field = $this->repository->find($id);

        if (!$this->repository->find($id)) {
            throw new AppException(ErrorCode::FIELD_NOT_FOUND);
        }
        $field = $this->repository->find($id);

        return $field;
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function getFieldsSortedByDistance($userLat, $userLng)
    {
        $fields = $this->repository->getAvailableFields();

        $destinations = [];
        foreach ($fields as $field) {
            $destinations[] = [$field->longitude, $field->latitude];
        }

        $body = [
            'locations' => array_merge([[$userLng, $userLat]], $destinations),
            'metrics' => ['distance'],
            'units' => 'km',
        ];

        $client = new Client();
        $response = $client->post('https://api.openrouteservice.org/v2/matrix/driving-car', [
            'headers' => [
                'Authorization' => env('OPENROUTESERVICE_API_KEY'),
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
            ],
            'json' => $body,
        ]);

        $data = json_decode($response->getBody(), true);
        $distances = $data['distances'][0]; // distance from user to each field

        // Gắn khoảng cách vào field
        foreach ($fields as $index => $field) {
            $field->distance = round($distances[$index + 1], 2);
        }

        return $fields->sortBy('distance')->values(); // sort và reset index
    }
}
