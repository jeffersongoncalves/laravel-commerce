<?php

use JeffersonGoncalves\Commerce\Region\Models\Country;
use JeffersonGoncalves\Commerce\Region\Models\Region;
use JeffersonGoncalves\Commerce\Region\Services\RegionService;

it('creates a region with a prefixed id', function () {
    $region = (new RegionService)->create([
        'name' => 'Europe',
        'currency_code' => 'eur',
    ]);

    expect($region->id)->toStartWith('reg_')
        ->and($region->currency_code)->toBe('eur');
});

it('relates countries to a region', function () {
    $region = Region::factory()->create();
    Country::factory()->create(['region_id' => $region->id]);
    Country::factory()->create(['region_id' => $region->id]);

    expect($region->countries)->toHaveCount(2)
        ->and($region->countries->first()->region->id)->toBe($region->id);
});
