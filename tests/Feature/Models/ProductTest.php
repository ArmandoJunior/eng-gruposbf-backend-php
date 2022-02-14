<?php

namespace Tests\Feature\Models;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all(): void
    {
        Product::factory()->count(10)->create();
        $response = $this->get('/api/products');
        $response->assertJsonCount(4);
        $response->assertStatus(200);
    }

    public function test_get_one(): void
    {
        $product = Product::query()->create([
            'name' => 'Air MAx',
            'amount' => 599.59,
        ]);
        $response = $this->get("/api/products/{$product->id}");
        $response->assertJsonCount(1);
        $response->assertStatus(200);
    }

    public function test_get_one_not_found(): void
    {
        $response = $this->get("/api/products/asdasdasds12312321");
        $response->assertNotFound();
        $response->assertStatus(404);
    }
}
