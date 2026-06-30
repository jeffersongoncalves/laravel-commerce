<?php

namespace JeffersonGoncalves\Commerce\Fulfillment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Fulfillment\Models\Fulfillment;
use JeffersonGoncalves\Commerce\Fulfillment\Models\FulfillmentItem;

/**
 * @extends Factory<FulfillmentItem>
 */
class FulfillmentItemFactory extends Factory
{
    protected $model = FulfillmentItem::class;

    public function definition(): array
    {
        return [
            'fulfillment_id' => Fulfillment::factory(),
            'title' => $this->faker->words(2, true),
            'quantity' => $this->faker->numberBetween(1, 5),
            'metadata' => null,
        ];
    }
}
