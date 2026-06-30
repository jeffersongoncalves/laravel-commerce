<?php

use JeffersonGoncalves\Commerce\Region\Database\Seeders\CountrySeeder;
use JeffersonGoncalves\Commerce\Region\Database\Seeders\RegionSeeder;
use JeffersonGoncalves\Commerce\Region\Models\Country;
use JeffersonGoncalves\Commerce\Region\Models\Region;

it('seeds countries and regions idempotently', function () {
    (new CountrySeeder)->run();
    (new RegionSeeder)->run();
    (new CountrySeeder)->run();
    (new RegionSeeder)->run();

    expect(Country::query()->count())->toBe(5)
        ->and(Country::query()->find('br')->name)->toBe('Brazil')
        ->and(Region::query()->count())->toBe(4)
        ->and(Region::query()->where('name', 'Europe')->value('currency_code'))->toBe('eur');
});
