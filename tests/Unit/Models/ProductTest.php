<?php

namespace Tests\Unit\Models;

use App\Models\Product;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    private Product $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->product = new Product();
    }

    public function test_attributes(): void
    {
        $this->assertEquals(['model', 'amount', 'gender', 'image_url', 'brand_id', 'category_id'], $this->product->getFillable());
        $this->assertEquals(['id' => 'string'], $this->product->getCasts());
        $this->assertEquals(false, $this->product->getIncrementing());
    }

    public function test_if_use_traits(): void
    {
        $traitsExpecteds = [HasFactory::class, Uuid::class];
        $classUses = class_uses($this->product);

        $this->assertEquals($traitsExpecteds, array_keys($classUses));
    }
}
