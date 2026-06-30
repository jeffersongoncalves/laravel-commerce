<?php

use JeffersonGoncalves\Commerce\ApiKey\Enums\ApiKeyType;
use JeffersonGoncalves\Commerce\ApiKey\Models\ApiKey;
use JeffersonGoncalves\Commerce\Inventory\Models\InventoryItem;
use JeffersonGoncalves\Commerce\Inventory\Models\InventoryLevel;
use JeffersonGoncalves\Commerce\Order\Models\Order;
use JeffersonGoncalves\Commerce\Product\Models\ProductVariant;

beforeEach(function () {
    ApiKey::factory()->create(['token' => 'sk_test', 'type' => ApiKeyType::Secret, 'revoked_at' => null]);
    $this->auth = ['Authorization' => 'Bearer sk_test'];
});

function admStockedVariant(string $sku, int $stocked): ProductVariant
{
    $variant = ProductVariant::factory()->create(['sku' => $sku]);
    $item = InventoryItem::factory()->create(['sku' => $sku]);
    InventoryLevel::factory()->create(['inventory_item_id' => $item->id, 'location_id' => 'sloc_main', 'stocked_quantity' => $stocked, 'reserved_quantity' => 0]);

    return $variant;
}

it('rejects requests without a secret api key', function () {
    $this->getJson('/admin/commerce/products')->assertStatus(401);
});

it('performs product CRUD over the admin api', function () {
    $id = $this->withHeaders($this->auth)
        ->postJson('/admin/commerce/products', ['title' => 'Phone', 'handle' => 'phone'])
        ->assertCreated()
        ->json('product.id');

    $this->withHeaders($this->auth)->getJson('/admin/commerce/products')->assertOk();
    $this->withHeaders($this->auth)->getJson("/admin/commerce/products/{$id}")->assertOk()->assertJsonPath('product.id', $id);

    $this->withHeaders($this->auth)
        ->patchJson("/admin/commerce/products/{$id}", ['title' => 'Phone X'])
        ->assertOk()
        ->assertJsonPath('product.title', 'Phone X');

    $this->withHeaders($this->auth)->deleteJson("/admin/commerce/products/{$id}")->assertNoContent();
});

it('processes a return over the admin api', function () {
    $variant = admStockedVariant('SKU-ADM-1', 10);

    $order = Order::factory()->create(['currency_code' => 'usd']);
    $line = $order->items()->create([
        'title' => 'X', 'quantity' => 3, 'unit_price' => 1000,
        'product_id' => $variant->product_id, 'variant_id' => $variant->id,
    ]);

    $this->withHeaders($this->auth)
        ->postJson("/admin/commerce/orders/{$order->id}/returns", [
            'items' => [$line->id => 2],
            'refund_amount' => 2000,
            'location_id' => 'sloc_main',
        ])
        ->assertCreated()
        ->assertJsonPath('return.status', 'received');

    $level = InventoryLevel::query()->where('inventory_item_id', InventoryItem::query()->where('sku', 'SKU-ADM-1')->value('id'))->first();
    expect($level->stocked_quantity)->toBe(12)
        ->and($order->fresh()->refundedTotal())->toBe(2000);
});
