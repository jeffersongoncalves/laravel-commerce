<?php

namespace JeffersonGoncalves\Commerce\Storefront\Http\Controllers;

use Illuminate\Http\JsonResponse;
use JeffersonGoncalves\Commerce\Order\Models\Order;

class OrderController
{
    public function show(string $order): JsonResponse
    {
        $order = Order::query()->findOrFail($order);
        $order->loadMissing('items');

        return response()->json([
            'order' => [
                'id' => $order->id,
                'status' => $order->status->value,
                'currency_code' => $order->currency_code,
                'total' => $order->total(),
                'items' => $order->items->map(fn ($i) => [
                    'id' => $i->id,
                    'title' => $i->title,
                    'quantity' => $i->quantity,
                    'unit_price' => $i->unit_price,
                ])->all(),
            ],
        ]);
    }
}
