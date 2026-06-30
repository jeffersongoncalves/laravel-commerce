<?php

namespace JeffersonGoncalves\Commerce\Admin\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JeffersonGoncalves\Commerce\Checkout\Services\OrderEditService;
use JeffersonGoncalves\Commerce\Checkout\Services\ReturnService;
use JeffersonGoncalves\Commerce\Order\Models\Order;

class AdminOrderController
{
    public function index(): JsonResponse
    {
        return response()->json(['orders' => Order::query()->latest()->limit(100)->get()]);
    }

    public function show(string $order): JsonResponse
    {
        return response()->json(['order' => Order::query()->with(['items', 'transactions', 'returns'])->findOrFail($order)]);
    }

    public function storeReturn(Request $request, string $order): JsonResponse
    {
        /** @var array<string, int> $items */
        $items = (array) $request->input('items', []);

        $return = (new ReturnService)->create(
            $order,
            $items,
            $request->integer('refund_amount') ?: null,
            $request->input('location_id'),
        );

        return response()->json(['return' => $return->load('items')], 201);
    }

    public function storeItem(Request $request, string $order): JsonResponse
    {
        $item = (new OrderEditService)->addItem($order, $request->only([
            'title', 'quantity', 'unit_price', 'product_id', 'variant_id',
        ]));

        return response()->json(['item' => $item], 201);
    }
}
