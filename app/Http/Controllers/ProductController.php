<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    public function index()
    {
        $productsCollection = Product::query()->paginate();
        return new ProductCollection($productsCollection);
    }

    /**
     * @param $id
     * @return ProductResource|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $product = Product::query()->findOrFail($id);
            return new ProductResource($product);
        } catch (ModelNotFoundException $e) {
            return response()->json(["error" => "Product not found"], 404);
        } catch (\Exception $e) {
            return response()->json(["error" => "Server error"], 500);
        }
    }
}
