<?php

namespace JeffersonGoncalves\Commerce\Region\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Region\Models\Region;

/**
 * @extends Factory<Region>
 */
class RegionFactory extends Factory
{
    protected $model = Region::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->country(),
            'currency_code' => 'usd',
            'metadata' => null,
        ];
    }
}
