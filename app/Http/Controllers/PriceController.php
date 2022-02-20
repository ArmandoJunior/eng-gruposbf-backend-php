<?php

namespace App\Http\Controllers;

use App\Dtos\PriceDto;
use App\Http\Requests\StorePriceRequest;
use App\Http\Resources\PriceResource;
use App\Models\Price;
use App\Services\Currency\CurrencyApi;
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
        CreatePriceWithCurrencyApiIntegration $createPriceWithCurrencyApiIntegration
    ) {
        try {
            $fields = json_decode($request->getContent());
            $price = $createPriceWithCurrencyApiIntegration->setData(new PriceDto($fields))->execute();
            return new PriceResource($price);
        } catch (\DomainException $e) {
            return response()->json($e->getMessage(), $e->getCode());
        } catch (\Exception $e) {
            return response()->json('Server Error', 500);
        }
    }

    public function renew(CurrencyApi $currencyApi)
    {
        $prices = Price::all(['id', 'currency_code']);

        try {
            $prices->filter(function ($price) use ($currencyApi) {
                $currencyApi->setCurrencyCode($price->currency_code);

                /** Executa a busca do valor de referência para conversão dos preços para a região informada. */
                $currencyApi->execute();
                /** @var Price $price */
                $price->update(['value' => $currencyApi->getReferenceValue()]);
            });
        } catch (\DomainException $e) {
            return response()->json($e->getMessage(), $e->getCode());
        } catch (\Exception $e) {
            return response()->json('Server Error', 500);
        }

        $priceCollection = Price::all(['currency_code', 'value', 'territory', 'created_at', 'updated_at']);
        return PriceResource::collection($priceCollection);
    }
}
