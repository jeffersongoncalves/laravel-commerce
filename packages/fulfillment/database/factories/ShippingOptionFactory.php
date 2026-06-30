<?php

namespace JeffersonGoncalves\Commerce\Fulfillment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Fulfillment\Models\ServiceZone;
use JeffersonGoncalves\Commerce\Fulfillment\Models\ShippingOption;

/**
 * @extends Factory<ShippingOption>
 */
class ShippingOptionFactory extends Factory
{
    protected $model = ShippingOption::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Standard', 'Express', 'Pickup']),
            'service_zone_id' => ServiceZone::factory(),
            'provider_id' => 'manual_manual',
            'price_type' => 'flat',
            'data' => null,
            'metadata' => null,
        ];
    }
}
