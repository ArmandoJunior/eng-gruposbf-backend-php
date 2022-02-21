<?php

namespace App\Services\Currency;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class CurrencyApi implements CurrencyInterface
{
    private string $currencyCode;
    private string $uri;
    private Response $response;
    private string $referenceValue;
    private string $currencyCodeResponse;

    public function __construct()
    {
        $this->uri = env('CURRENCY_API_URI', 'local');
    }

    public function setCurrencyCode(string $code): CurrencyInterface
    {
        $this->currencyCode = "BRL-$code";
        return $this;
    }

    public function execute(): CurrencyInterface
    {
        $this->response = Http::get("{$this->uri}/{$this->currencyCode}");
        $responseObject = $this->responseValidate();
        $this->referenceValue = $responseObject->high;
        $this->currencyCodeResponse = $responseObject->codein;

        return $this;
    }

    public function getReferenceValue(): string
    {
        return $this->referenceValue;
    }

    public function getCurrencyCodeFromResponse(): string
    {
        return $this->currencyCodeResponse;
    }

    private function responseValidate(): object
    {
        $object = $this->response->object();

        if (isset($object->status)) {
            throw new \DomainException("$object->code - $object->message", $object->status);
        }

        return reset($object);
    }
}
