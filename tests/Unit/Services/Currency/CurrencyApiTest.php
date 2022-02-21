<?php

namespace Tests\Unit\Services\Currency;

use App\Services\Currency\CurrencyApi;
use App\Services\Currency\CurrencyInterface;
use PHPUnit\Framework\TestCase;

class CurrencyApiTest extends TestCase
{

    public function testIfHasInterface()
    {
        $currencyApi = new \ReflectionClass(CurrencyApi::class);
        $reflectionClasses = $currencyApi->getInterfaceNames();
        $this->assertEquals(CurrencyInterface::class, $reflectionClasses[0]);
    }

    /**
     * @throws \ReflectionException
     */
    public function test__construct()
    {
        $currencyApi = new \ReflectionClass(CurrencyApi::class);

        $this->assertInstanceOf(CurrencyApi::class, $currencyApi->newInstance());
    }

    public function test_attributes()
    {
        $currencyApi = new CurrencyApi();
        $this->assertObjectHasAttribute('currencyCode', $currencyApi);
        $this->assertObjectHasAttribute('uri', $currencyApi);
        $this->assertObjectHasAttribute('response', $currencyApi);
        $this->assertObjectHasAttribute('referenceValue', $currencyApi);
        $this->assertObjectHasAttribute('currencyCodeResponse', $currencyApi);
    }

}
