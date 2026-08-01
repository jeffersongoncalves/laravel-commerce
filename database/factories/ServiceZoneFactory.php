<?php

namespace JeffersonGoncalves\Commerce\Fulfillment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Fulfillment\Models\FulfillmentSet;
use JeffersonGoncalves\Commerce\Fulfillment\Models\ServiceZone;

/**
 * @extends Factory<ServiceZone>
 */
class ServiceZoneFactory extends Factory
{
    protected $model = ServiceZone::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->city(),
            'fulfillment_set_id' => FulfillmentSet::factory(),
            'metadata' => null,
        ];
    }
}
