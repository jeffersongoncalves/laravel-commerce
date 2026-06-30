<?php

use JeffersonGoncalves\Commerce\Store\Models\Store;
use JeffersonGoncalves\Commerce\Store\Services\StoreService;

it('creates a store with a prefixed id', function () {
    $store = (new StoreService)->create([
        'name' => 'Acme',
        'default_currency_code' => 'usd',
    ]);

    expect($store->id)->toStartWith('store_')
        ->and($store->name)->toBe('Acme');
});

it('casts metadata to an array', function () {
    $store = Store::factory()->create(['metadata' => ['plan' => 'pro']]);

    expect($store->fresh()->metadata)->toBe(['plan' => 'pro']);
});
