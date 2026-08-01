<?php

use JeffersonGoncalves\Commerce\Tax\Models\TaxRate;
use JeffersonGoncalves\Commerce\Tax\Models\TaxRegion;

it('creates a tax region with a prefixed id', function () {
    $region = TaxRegion::factory()->create(['country_code' => 'us']);

    expect($region->id)->toStartWith('txreg_')
        ->and($region->country_code)->toBe('us');
});

it('relates rates to a region', function () {
    $region = TaxRegion::factory()->create();
    TaxRate::factory()->count(2)->create(['tax_region_id' => $region->id]);

    expect($region->rates)->toHaveCount(2)
        ->and($region->rates->first()->id)->toStartWith('txrate_')
        ->and($region->rates->first()->region->id)->toBe($region->id);
});
