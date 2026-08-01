<?php

namespace JeffersonGoncalves\Commerce\Fulfillment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Fulfillment\Models\Fulfillment;

/**
 * @extends Factory<Fulfillment>
 */
class FulfillmentFactory extends Factory
{
    protected $model = Fulfillment::class;

    public function definition(): array
    {
        return [
            'location_id' => 'sloc_'.$this->faker->lexify('??????'),
            'provider_id' => 'manual_manual',
            'metadata' => null,
        ];
    }
}
