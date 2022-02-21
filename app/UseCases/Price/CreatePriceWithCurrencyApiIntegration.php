<?php

namespace App\UseCases\Price;

use App\Dtos\DtoInterface;
use App\Dtos\PriceDto;
use App\Models\Price;
use App\Services\Currency\CurrencyApi;
use App\Services\Currency\CurrencyInterface;
use App\UseCases\UseCaseInterface;
use Illuminate\Database\Eloquent\Model;

class CreatePriceWithCurrencyApiIntegration implements UseCaseInterface
{
    private DtoInterface $data;
    private CurrencyInterface $currencyApi;

    public function __construct(CurrencyApi $currencyApi)
    {
        $this->currencyApi = $currencyApi;
    }

    public function execute(): Model
    {
        $this->currencyApi->setCurrencyCode($this->data->getCurrencyCode());
        $this->currencyApi->execute();
        return $this->createPrice($this->data);
    }

    public function setData(DtoInterface $data): UseCaseInterface
    {
        $this->data = $data;
        return $this;
    }

    private function createPrice(PriceDto $dto): Model
    {
        return Price::query()->create([
            'value' => $this->currencyApi->getReferenceValue(),
            'currency_code' => $this->currencyApi->getCurrencyCodeFromResponse(),
            'territory' => $dto->getTerritory()
        ]);
    }
}
