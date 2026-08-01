<?php

use JeffersonGoncalves\Commerce\Cart\Models\Cart;
use JeffersonGoncalves\Commerce\Cart\Models\CartShippingMethod;
use JeffersonGoncalves\Commerce\Cart\Services\CartService;

it('creates a cart with a prefixed id', function () {
    $cart = (new CartService)->create(['currency_code' => 'usd']);

    expect($cart->id)->toStartWith('cart_');
});

it('adds line items and totals the cart', function () {
    $service = new CartService;
    $cart = $service->create(['currency_code' => 'usd']);

    $service->addLineItem($cart->id, ['title' => 'A', 'quantity' => 2, 'unit_price' => 500]);
    $service->addLineItem($cart->id, ['title' => 'B', 'quantity' => 1, 'unit_price' => 1500]);

    $cart->load('items', 'shippingMethods');

    expect($cart->items)->toHaveCount(2)
        ->and($cart->itemSubtotal())->toBe(2500)
        ->and($cart->total())->toBe(2500);
});

it('includes shipping in the total', function () {
    $cart = Cart::factory()->create();
    $cart->items()->create(['title' => 'A', 'quantity' => 1, 'unit_price' => 1000]);
    CartShippingMethod::factory()->create(['cart_id' => $cart->id, 'amount' => 700]);

    $cart->load('items', 'shippingMethods');

    expect($cart->total())->toBe(1700);
});
