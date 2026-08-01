<?php

use JeffersonGoncalves\Commerce\Inventory\Models\InventoryItem;
use JeffersonGoncalves\Commerce\Inventory\Models\InventoryLevel;
use JeffersonGoncalves\Commerce\Inventory\Services\InventoryService;

it('creates an inventory item with a prefixed id', function () {
    $item = InventoryItem::factory()->create();

    expect($item->id)->toStartWith('iitem_');
});

it('computes available quantity from stocked minus reserved', function () {
    $level = InventoryLevel::factory()->create([
        'stocked_quantity' => 100,
        'reserved_quantity' => 30,
    ]);

    expect($level->availableQuantity())->toBe(70);
});

it('reserves stock through the service', function () {
    $item = InventoryItem::factory()->create();
    $level = InventoryLevel::factory()->create([
        'inventory_item_id' => $item->id,
        'location_id' => 'sloc_main',
        'stocked_quantity' => 50,
        'reserved_quantity' => 0,
    ]);

    $updated = (new InventoryService)->reserve($item->id, 'sloc_main', 20);

    expect($updated->reserved_quantity)->toBe(20)
        ->and($updated->availableQuantity())->toBe(30);
});

it('refuses to over-reserve', function () {
    $item = InventoryItem::factory()->create();
    InventoryLevel::factory()->create([
        'inventory_item_id' => $item->id,
        'location_id' => 'sloc_main',
        'stocked_quantity' => 5,
        'reserved_quantity' => 0,
    ]);

    (new InventoryService)->reserve($item->id, 'sloc_main', 10);
})->throws(RuntimeException::class);
