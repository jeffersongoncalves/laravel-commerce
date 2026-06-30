<?php

namespace JeffersonGoncalves\Commerce\Fulfillment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Fulfillment\Models\FulfillmentSet;

/**
 * @extends Factory<FulfillmentSet>
 */
class FulfillmentSetFactory extends Factory
{
    protected $model = FulfillmentSet::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'type' => $this->faker->randomElement(['shipping', 'pickup']),
            'metadata' => null,
        ];
    }
}
