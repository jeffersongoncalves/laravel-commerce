<?php

namespace JeffersonGoncalves\Commerce\Pricing\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Pricing\Models\PriceSet;

/**
 * @extends Factory<PriceSet>
 */
class PriceSetFactory extends Factory
{
    protected $model = PriceSet::class;

    public function definition(): array
    {
        return [
            'metadata' => null,
        ];
    }
}
