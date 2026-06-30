<?php

use JeffersonGoncalves\Commerce\Order\Models\Order;
use JeffersonGoncalves\Commerce\Order\Models\OrderClaim;

it('records a claim with items against an order', function () {
    $order = Order::factory()->create();
    $line = $order->items()->create(['title' => 'X', 'quantity' => 2, 'unit_price' => 1000]);

    $claim = OrderClaim::query()->create([
        'order_id' => $order->id,
        'type' => 'refund',
        'status' => 'open',
        'refund_amount' => 1000,
    ]);
    $claim->items()->create(['order_line_item_id' => $line->id, 'quantity' => 1, 'reason' => 'damaged']);

    expect($claim->id)->toStartWith('claim_')
        ->and($order->claims)->toHaveCount(1)
        ->and($claim->items)->toHaveCount(1)
        ->and($claim->items->first()->reason)->toBe('damaged')
        ->and($claim->items->first()->claim->id)->toBe($claim->id);
});
