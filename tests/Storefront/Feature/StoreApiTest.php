<?php

use JeffersonGoncalves\Commerce\ApiKey\Enums\ApiKeyType;
use JeffersonGoncalves\Commerce\ApiKey\Models\ApiKey;
use JeffersonGoncalves\Commerce\Inventory\Models\InventoryItem;
use JeffersonGoncalves\Commerce\Inventory\Models\InventoryLevel;
use JeffersonGoncalves\Commerce\Pricing\Models\Price;
use JeffersonGoncalves\Commerce\Pricing\Models\PriceSet;
use JeffersonGoncalves\Commerce\Product\Enums\ProductStatus;
use JeffersonGoncalves\Commerce\Product\Models\Product;
use JeffersonGoncalves\Commerce\Product\Models\ProductVariant;

beforeEach(function () {
    ApiKey::factory()->create(['token' => 'pk_test', 'type' => ApiKeyType::Publishable, 'revoked_at' => null]);
    $this->key = ['x-publishable-api-key' => 'pk_test'];
});

function sellableVariant(string $sku, int $amount = 2500, int $stocked = 100): ProductVariant
{
    $product = Product::factory()->published()->create();
    $variant = ProductVariant::factory()->create(['product_id' => $product->id, 'sku' => $sku]);
    $priceSet = PriceSet::factory()->create();
    $variant->update(['price_set_id' => $priceSet->id]);
    Price::factory()->create(['price_set_id' => $priceSet->id, 'currency_code' => 'usd', 'amount' => $amount, 'min_quantity' => null, 'max_quantity' => null]);

    $item = InventoryItem::factory()->create(['sku' => $sku]);
    InventoryLevel::factory()->create(['inventory_item_id' => $item->id, 'location_id' => 'sloc_main', 'stocked_quantity' => $stocked, 'reserved_quantity' => 0]);

    return $variant->fresh();
}

it('rejects requests without a publishable api key', function () {
    $this->getJson('/store/products')->assertStatus(401);
});

it('lists published products', function () {
    Product::factory()->published()->create(['title' => 'Live']);
    Product::factory()->create(['title' => 'Draft', 'status' => ProductStatus::Draft]);

    $this->withHeaders($this->key)->getJson('/store/products')
        ->assertOk()
        ->assertJsonCount(1, 'products')
        ->assertJsonPath('products.0.title', 'Live');
});

it('runs the full store checkout flow over the api', function () {
    $variant = sellableVariant('SKU-API-1', 2500, 100);

    $cartId = $this->withHeaders($this->key)
        ->postJson('/store/carts', ['currency_code' => 'usd'])
        ->assertCreated()
        ->json('cart.id');

    $this->withHeaders($this->key)
        ->postJson("/store/carts/{$cartId}/line-items", ['variant_id' => $variant->id, 'quantity' => 2])
        ->assertOk()
        ->assertJsonPath('cart.totals.subtotal', 5000);

    $orderId = $this->withHeaders($this->key)
        ->postJson("/store/carts/{$cartId}/complete")
        ->assertCreated()
        ->assertJsonPath('order.total', 5000)
        ->json('order.id');

    $this->withHeaders($this->key)->getJson("/store/orders/{$orderId}")
        ->assertOk()
        ->assertJsonPath('order.id', $orderId)
        ->assertJsonCount(1, 'order.items');

    $level = InventoryLevel::query()->first();
    expect($level->reserved_quantity)->toBe(2);
});
