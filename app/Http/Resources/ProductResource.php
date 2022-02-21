<?php

namespace App\Http\Resources;

use App\Models\Price;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * * Transform the resource into an array.
     *
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        $amount = $this->amount;
        $prices = Price::all(['currency_code', 'value', 'territory']);
        $pricesFiltered = $prices->filter(function ($obj) use ($amount) {
            $value = $obj->value * $amount;
            $obj->value = number_format($value, 2, ',', '.');
            $obj->price_description = "{$obj->currency_code}: {$obj->value} ({$obj->territory})";
            return $obj;
        });

        return [
            'id' => $this->id,
            'image_url' => $this->image_url,
            'brand' => $this->brand->name,
            'gender' => $this->gender,
            'category' => $this->category->name,
            'model' => $this->model,
            'amount' => number_format($this->amount, '2', ',', '.'),
            'prices' => $pricesFiltered
        ];
    }
}
