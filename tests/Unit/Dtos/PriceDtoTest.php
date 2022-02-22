<?php

namespace Tests\Unit\Dtos;

use App\Dtos\PriceDto;
use PHPUnit\Framework\TestCase;

class PriceDtoTest extends TestCase
{
    private PriceDto $priceDto;

    protected function setUp(): void
    {
        parent::setUp();

        $stdClass = new \stdClass();
        $stdClass->currency_code = 'BRL';
        $stdClass->territory = 'brasil';

        $this->priceDto = new PriceDto($stdClass);
    }

    public function test__construct()
    {
        $hasConstruct = method_exists($this->priceDto, '__construct');
        $this->assertTrue($hasConstruct);
        $this->assertInstanceOf(PriceDto::class, $this->priceDto);
    }

    public function test_getTerritory()
    {
        $hasGetTerritoryMethod = method_exists($this->priceDto, 'getTerritory');
        $this->assertTrue($hasGetTerritoryMethod);
        $this->assertEquals('brasil', $this->priceDto->getTerritory());
    }

    public function test_getCurrencyCode()
    {
        $hasGetCurrencyCodeMethod = method_exists($this->priceDto, 'getCurrencyCode');
        $this->assertTrue($hasGetCurrencyCodeMethod);
        $this->assertEquals('BRL', $this->priceDto->getCurrencyCode());
    }

    public function test_if_dont_have_setTerritory_method()
    {
        $hasGetTerritoryMethod = method_exists($this->priceDto, 'setTerritory');
        $this->assertFalse($hasGetTerritoryMethod);
    }

    public function test_if_dont_have_setCurrencyCode_method()
    {
        $hasGetCurrencyCodeMethod = method_exists($this->priceDto, 'setCurrencyCode');
        $this->assertFalse($hasGetCurrencyCodeMethod);
    }

    public function test_class_attributes()
    {
        $reflectionClass = new \ReflectionClass(PriceDto::class);
        $properties = $reflectionClass->getProperties();
        $numberOfAttributesExpeted = 2;
        $this->assertCount($numberOfAttributesExpeted, $properties);
        foreach ($properties as $property) {
            $this->assertContains($property->getName(), ['currencyCode', 'territory']);
            $this->assertEquals('string', $property->getType()->getName());
            $modifiers = \Reflection::getModifierNames($property->getModifiers());
            $this->assertEquals('private', reset($modifiers));
        }
    }
}
