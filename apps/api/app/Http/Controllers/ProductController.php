<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index()
    {
        return Product::with('category')->paginate();
    }

    public function store(ProductStoreRequest $request): JsonResponse
    {
        $product = Product::create($request->validated());

        return response()->json($product->load('category'), 201);
    }

    public function show(Product $product): Product
    {
        return $product->load('category');
    }

    public function update(ProductUpdateRequest $request, Product $product): Product
    {
        $product->update($request->validated());

        return $product->load('category');
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json(null, 204);
    }
}
