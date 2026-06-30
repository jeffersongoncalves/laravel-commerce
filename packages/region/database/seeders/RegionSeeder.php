<?php

namespace JeffersonGoncalves\Commerce\Region\Database\Seeders;

use Illuminate\Database\Seeder;
use JeffersonGoncalves\Commerce\Region\Models\Region;

class RegionSeeder extends Seeder
{
    /**
     * @var list<array{name: string, currency_code: string}>
     */
    protected array $regions = [
        ['name' => 'North America', 'currency_code' => 'usd'],
        ['name' => 'Europe', 'currency_code' => 'eur'],
        ['name' => 'United Kingdom', 'currency_code' => 'gbp'],
        ['name' => 'Brazil', 'currency_code' => 'brl'],
    ];

    public function run(): void
    {
        foreach ($this->regions as $region) {
            Region::query()->updateOrCreate(['name' => $region['name']], $region);
        }
    }
}
