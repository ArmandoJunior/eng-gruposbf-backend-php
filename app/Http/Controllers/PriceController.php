<?php

namespace App\Http\Controllers;

use App\Dtos\PriceDto;
use App\Http\Requests\StorePriceRequest;
use App\Http\Resources\PriceResource;
use App\Models\Price;
use App\UseCases\Price\CreatePriceWithCurrencyApiIntegration;

class PriceController extends Controller
{
    public function index()
    {
        $priceCollection = Price::all(['currency_code', 'value', 'territory', 'updated_at']);
        return PriceResource::collection($priceCollection);
    }

    public function store(
        StorePriceRequest $request,
        CreatePriceWithCurrencyApiIntegration $createPriceWithCurrencyApiIntegration)
    {
        try {
            $fields = json_decode($request->getContent());
            $dto = new PriceDto($fields);
            $price = $createPriceWithCurrencyApiIntegration->execute($dto);
            return new PriceResource($price);
        }catch (\Exception $e) {
            response()->json('error', 500);
        }
    }
}
