<?php

namespace App\Services\Currency;

interface CurrencyInterface
{
    public function setCurrencyCode(string $code): self;

    public function execute(): self;

    public function getReferenceValue(): string;

    public function getCurrencyCodeFromResponse(): string;
}
