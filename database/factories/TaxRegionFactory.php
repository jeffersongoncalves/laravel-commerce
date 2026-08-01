<?php

namespace JeffersonGoncalves\Commerce\Tax\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Tax\Models\TaxRegion;

/**
 * @extends Factory<TaxRegion>
 */
class TaxRegionFactory extends Factory
{
    protected $model = TaxRegion::class;

    public function definition(): array
    {
        return [
            'country_code' => strtolower($this->faker->countryCode()),
            'province_code' => null,
            'parent_id' => null,
            'metadata' => null,
        ];
    }
}
