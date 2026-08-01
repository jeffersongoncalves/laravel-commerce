<?php

namespace JeffersonGoncalves\Commerce\Tax\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Tax\Models\TaxRate;
use JeffersonGoncalves\Commerce\Tax\Models\TaxRegion;

/**
 * @extends Factory<TaxRate>
 */
class TaxRateFactory extends Factory
{
    protected $model = TaxRate::class;

    public function definition(): array
    {
        return [
            'tax_region_id' => TaxRegion::factory(),
            'rate' => $this->faker->randomFloat(2, 0, 25),
            'code' => $this->faker->lexify('TAX???'),
            'name' => $this->faker->words(2, true),
            'is_default' => false,
            'is_combinable' => false,
            'metadata' => null,
        ];
    }
}
