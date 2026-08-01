<?php

namespace JeffersonGoncalves\Commerce\Pricing\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Pricing\Models\Price;
use JeffersonGoncalves\Commerce\Pricing\Models\PriceSet;

/**
 * @extends Factory<Price>
 */
class PriceFactory extends Factory
{
    protected $model = Price::class;

    public function definition(): array
    {
        return [
            'amount' => $this->faker->numberBetween(100, 100000),
            'currency_code' => 'usd',
            'price_set_id' => PriceSet::factory(),
            'price_list_id' => null,
            'min_quantity' => null,
            'max_quantity' => null,
            'metadata' => null,
        ];
    }
}
