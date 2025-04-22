<?php

namespace App\Responses;

use Illuminate\Support\Facades\Hash;

class PaginateResponse
{
    public static function paginateToJsonForm($items = null)
    {
        return [
            'items' => $items->items(),
            'pagination' => [
                'current_page' => $items->currentPage(),
                'per_page' => $items->perPage(),
                'total_item' => $items->total(),
                'last_page' => $items->lastPage(),
            ]
        ];
    }
}
