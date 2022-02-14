<?php

namespace App\Http\Resources;

use App\Models\Price;
use Illuminate\Http\Resources\Json\JsonResource;

class PriceResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'currency_code' => $this->currency_code,
            'reference_base_value' => 1.00,
            'reference_conversion_value' => $this->value,
            'territory' => $this->territory,
            'updated_at' => $this->updated_at
        ];
    }
}
