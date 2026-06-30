<?php

namespace JeffersonGoncalves\Commerce\Storefront\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JeffersonGoncalves\Commerce\Cart\Models\Cart;
use JeffersonGoncalves\Commerce\Checkout\Services\CartCalculator;
use JeffersonGoncalves\Commerce\Checkout\Services\CheckoutService;
use JeffersonGoncalves\Commerce\Checkout\Services\PricingResolver;
use JeffersonGoncalves\Commerce\Product\Models\ProductVariant;

class CartController
{
    public function store(Request $request): JsonResponse
    {
        $cart = Cart::query()->create([
            'currency_code' => (string) $request->input('currency_code', 'usd'),
            'email' => $request->input('email'),
            'region_id' => $request->input('region_id'),
            'sales_channel_id' => $request->input('sales_channel_id'),
            'shipping_address' => $request->input('shipping_address'),
        ]);

        return response()->json(['cart' => $this->present($cart)], 201);
    }

    public function addLineItem(Request $request, string $cart): JsonResponse
    {
        $cart = Cart::query()->findOrFail($cart);
        $variant = ProductVariant::query()->findOrFail((string) $request->input('variant_id'));
        $quantity = max(1, (int) $request->input('quantity', 1));

        $unitPrice = (new PricingResolver)->resolve($variant, $cart->currency_code, $quantity);

        if ($unitPrice === null) {
            abort(422, 'No price found for this variant and currency.');
        }

        $cart->items()->create([
            'title' => $variant->title,
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'product_id' => $variant->product_id,
            'variant_id' => $variant->id,
        ]);

        return response()->json(['cart' => $this->present($cart->fresh())]);
    }

    public function complete(string $cart): JsonResponse
    {
        $order = (new CheckoutService)->complete($cart);

        return response()->json([
            'order' => [
                'id' => $order->id,
                'status' => $order->status->value,
                'total' => $order->total(),
            ],
        ], 201);
    }

    /**
     * @return array<string, mixed>
     */
    private function present(Cart $cart): array
    {
        $cart->loadMissing('items', 'shippingMethods');

        return [
            'id' => $cart->id,
            'currency_code' => $cart->currency_code,
            'items' => $cart->items->map(fn ($i) => [
                'id' => $i->id,
                'title' => $i->title,
                'quantity' => $i->quantity,
                'unit_price' => $i->unit_price,
                'subtotal' => $i->subtotal(),
            ])->all(),
            'totals' => (new CartCalculator)->totals($cart),
        ];
    }
}
