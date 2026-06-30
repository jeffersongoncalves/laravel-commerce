<?php

namespace JeffersonGoncalves\Commerce\Region\Database\Seeders;

use Illuminate\Database\Seeder;
use JeffersonGoncalves\Commerce\Region\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * @var list<array{iso_2: string, iso_3: string, num_code: string, name: string, display_name: string}>
     */
    protected array $countries = [
        ['iso_2' => 'us', 'iso_3' => 'usa', 'num_code' => '840', 'name' => 'United States', 'display_name' => 'United States'],
        ['iso_2' => 'br', 'iso_3' => 'bra', 'num_code' => '076', 'name' => 'Brazil', 'display_name' => 'Brazil'],
        ['iso_2' => 'gb', 'iso_3' => 'gbr', 'num_code' => '826', 'name' => 'United Kingdom', 'display_name' => 'United Kingdom'],
        ['iso_2' => 'de', 'iso_3' => 'deu', 'num_code' => '276', 'name' => 'Germany', 'display_name' => 'Germany'],
        ['iso_2' => 'fr', 'iso_3' => 'fra', 'num_code' => '250', 'name' => 'France', 'display_name' => 'France'],
    ];

    public function run(): void
    {
        foreach ($this->countries as $country) {
            Country::query()->updateOrCreate(['iso_2' => $country['iso_2']], $country);
        }
    }
}
