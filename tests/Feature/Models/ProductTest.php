<?php

namespace Tests\Feature\Models;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Faker\Provider\Image;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

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
        $imageUrl = Image::imageUrl(250, 250, 'tennis');
        $brand = Brand::query()->create(['name' => 'Nike']);
        $category = Category::query()->create(['name' => 'Tênis']);
        $product = Product::query()->create([
            'model' => 'Air MAx',
            'amount' => 599.59,
            'gender' => 'masculino',
            'brand_id' => $brand->id,
            'category_id' => $category->id,
            'image_url' => $imageUrl
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
