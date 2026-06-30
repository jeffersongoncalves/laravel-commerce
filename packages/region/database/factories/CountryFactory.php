<?php

namespace JeffersonGoncalves\Commerce\Region\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Region\Models\Country;

/**
 * @extends Factory<Country>
 */
class CountryFactory extends Factory
{
    protected $model = Country::class;

    public function definition(): array
    {
        $code = $this->faker->unique()->countryCode();

        return [
            'iso_2' => strtolower($code),
            'iso_3' => strtolower($this->faker->lexify('???')),
            'num_code' => (string) $this->faker->numberBetween(1, 999),
            'name' => $this->faker->country(),
            'display_name' => $this->faker->country(),
            'region_id' => null,
        ];
    }
}
