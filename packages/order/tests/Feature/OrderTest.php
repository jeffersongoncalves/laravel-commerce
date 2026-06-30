<?php

use JeffersonGoncalves\Commerce\Order\Enums\OrderStatus;
use JeffersonGoncalves\Commerce\Order\Models\Order;
use JeffersonGoncalves\Commerce\Order\Models\OrderLineItem;
use JeffersonGoncalves\Commerce\Order\Services\OrderService;

it('creates an order with a prefixed id and default status', function () {
    $order = (new OrderService)->create(['currency_code' => 'usd']);

    expect($order->id)->toStartWith('order_')
        ->and($order->fresh()->status)->toBe(OrderStatus::Pending);
});

it('totals its line items', function () {
    $order = Order::factory()->create();
    OrderLineItem::factory()->create(['order_id' => $order->id, 'quantity' => 2, 'unit_price' => 500]);
    OrderLineItem::factory()->create(['order_id' => $order->id, 'quantity' => 1, 'unit_price' => 1500]);

    $order->load('items');

    expect($order->items)->toHaveCount(2)
        ->and($order->total())->toBe(2500);
});
