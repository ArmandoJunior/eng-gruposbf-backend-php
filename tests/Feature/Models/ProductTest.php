<?php

namespace Tests\Feature\Models;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

//    /**
//     * Creates the application.
//     *
//     * @return \Laravel\Lumen\Application
//     */
//    public function createApplication(): \Laravel\Lumen\Application
//    {
//        return require __DIR__ . '/../bootstrap/app.php';
//    }
    public function tearDown(): void
    {
        $this->artisan('migrate:reset');

        $this->beforeApplicationDestroyed(function () {
            DB::disconnect();
        });

        parent::tearDown();
    }

    public function test_get_all(): void
    {
        Brand::query()->create(['name' => 'Nike']);
        Brand::query()->create(['name' => 'Adidas']);
        Brand::query()->create(['name' => 'Asics']);
        Brand::query()->create(['name' => 'Rainha']);
        Category::query()->create(['name' => 'Tênis']);
        Product::factory()->count(10)->create();
        $response = $this->get('/api/products');
        $response->assertJsonCount(4);
        $response->assertStatus(200);
    }

    public function test_get_one(): void
    {
        $brand = Brand::query()->create(['name' => 'Nike']);
        $category = Category::query()->create(['name' => 'Tênis']);
        $product = Product::query()->create([
            'model' => 'Air MAx',
            'amount' => 599.59,
            'gender' => 'masculino',
            'brand_id' => $brand->id,
            'category_id' => $category->id,
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
