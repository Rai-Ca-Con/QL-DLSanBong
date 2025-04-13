<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FieldResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'FieldId'   => $this->id,
            'FieldName'       => $this->name,
            'FieldAddress' => $this->address,
            'FieldPrice'   => $this->price,
            'FieldDescription'  => $this->description,
        ];
    }
}
