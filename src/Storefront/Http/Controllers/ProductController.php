<?php

namespace JeffersonGoncalves\Commerce\Storefront\Http\Controllers;

use Illuminate\Http\JsonResponse;
use JeffersonGoncalves\Commerce\Product\Enums\ProductStatus;
use JeffersonGoncalves\Commerce\Product\Models\Product;

class ProductController
{
    public function index(): JsonResponse
    {
        $products = Product::query()
            ->where('status', ProductStatus::Published)
            ->with('variants')
            ->limit(50)
            ->get()
            ->map(fn (Product $product) => [
                'id' => $product->id,
                'title' => $product->title,
                'handle' => $product->handle,
                'status' => $product->status->value,
                'variants' => $product->variants->map(fn ($v) => [
                    'id' => $v->id,
                    'title' => $v->title,
                    'sku' => $v->sku,
                ])->all(),
            ]);

        return response()->json(['products' => $products]);
    }
}
