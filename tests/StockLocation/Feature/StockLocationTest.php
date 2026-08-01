<?php

use JeffersonGoncalves\Commerce\StockLocation\Models\StockLocation;
use JeffersonGoncalves\Commerce\StockLocation\Services\StockLocationService;

it('creates a stock location with a prefixed id', function () {
    $location = (new StockLocationService)->create(['name' => 'Main']);

    expect($location->id)->toStartWith('sloc_')
        ->and($location->name)->toBe('Main');
});

it('casts the address to an array', function () {
    $location = StockLocation::factory()->create();

    expect($location->fresh()->address)->toHaveKey('country_code');
});
