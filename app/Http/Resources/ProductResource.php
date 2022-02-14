<?php

namespace App\Http\Resources;

use App\Models\Price;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
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
            'brand' => $this->brand->name,
            'gender' => $this->gender,
            'category' => $this->category->name,
            'model' => $this->model,
            'amount' => number_format($this->amount, '2', ',', '.'),
            'prices' => $pricesFiltered
        ];
    }
}
