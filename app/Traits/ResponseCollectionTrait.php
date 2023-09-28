<?php

namespace App\Traits;

trait ResponseCollectionTrait
{
    protected function formatCollection($data): array
    {
        return [
            'items' => $data->collection,
            'pagination' => [
                'total' => $data->total(),
                'count' => $data->count(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'total_pages' => $data->lastPage()
            ],
        ];
    }
}
