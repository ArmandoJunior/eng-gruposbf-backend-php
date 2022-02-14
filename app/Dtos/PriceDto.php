<?php

namespace App\Dtos;

class PriceDto implements DtoInterface
{
    private string $currencyCode;
    private string $territory;

    public function __construct(\stdClass $objRequest)
    {
        $this->currencyCode = $objRequest->currency_code;
        $this->territory = $objRequest->territory;
    }

    /**
     * @return string
     */
    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    /**
     * @return string
     */
    public function getTerritory(): string
    {
        return $this->territory;
    }
}
