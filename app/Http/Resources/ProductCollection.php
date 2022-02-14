<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'status' => 'success',
            'data' => $this->collection->each(function ($product) {
                new ProductResource($product);
            })
        ];
    }
}
