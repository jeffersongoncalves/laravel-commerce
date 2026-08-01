<?php

namespace JeffersonGoncalves\Commerce\Admin\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JeffersonGoncalves\Commerce\Product\Models\Product;

class AdminProductController
{
    public function index(): JsonResponse
    {
        return response()->json(['products' => Product::query()->limit(100)->get()]);
    }

    public function store(Request $request): JsonResponse
    {
        $product = Product::query()->create($request->only([
            'title', 'subtitle', 'handle', 'description', 'status', 'thumbnail',
        ]));

        return response()->json(['product' => $product], 201);
    }

    public function show(string $product): JsonResponse
    {
        return response()->json(['product' => Product::query()->with('variants')->findOrFail($product)]);
    }

    public function update(Request $request, string $product): JsonResponse
    {
        $model = Product::query()->findOrFail($product);
        $model->update($request->only([
            'title', 'subtitle', 'handle', 'description', 'status', 'thumbnail',
        ]));

        return response()->json(['product' => $model]);
    }

    public function destroy(string $product): JsonResponse
    {
        Product::query()->findOrFail($product)->delete();

        return response()->json(status: 204);
    }
}
