<?php

namespace App\UseCases\Price;

use App\Dtos\DtoInterface;
use App\Dtos\PriceDto;
use App\Models\Price;
use App\UseCases\UseCaseInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class CreatePriceWithCurrencyApiIntegration implements UseCaseInterface
{

    public function execute(DtoInterface $dto): Model
    {
        /** @var PriceDto $dto */
        $response = $this->getResponseCurrencyApi($dto->getCurrencyCode());
        $objectResponse = $this->getRequestContentIntoObject($response, $dto);
        return $this->createPrice($objectResponse, $dto);
    }

    private function getResponseCurrencyApi(string $currencyCode): Response
    {
        return Http::get("https://economia.awesomeapi.com.br/last/BRL-$currencyCode");
    }

    /**
     * @param Response $response
     * @param $dto
     * @return mixed
     */
    private function getRequestContentIntoObject(Response $response, $dto)
    {
        $body = $response->body();
        $jsonResponse = json_decode($body);
        $attribute = "BRL{$dto->getCurrencyCode()}";
        $json = $jsonResponse->$attribute;
        return $json;
    }

    /**
     * @param $objectResponse
     * @param $dto
     * @return Model
     */
    private function createPrice($objectResponse, $dto): Model
    {
        return Price::query()->create([
            'value' => $objectResponse->high,
            'currency_code' => $objectResponse->codein,
            'territory' => $dto->getTerritory()
        ]);
    }
}
