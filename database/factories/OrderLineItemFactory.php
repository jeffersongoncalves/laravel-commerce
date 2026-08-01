<?php

namespace JeffersonGoncalves\Commerce\Order\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Order\Models\Order;
use JeffersonGoncalves\Commerce\Order\Models\OrderLineItem;

/**
 * @extends Factory<OrderLineItem>
 */
class OrderLineItemFactory extends Factory
{
    protected $model = OrderLineItem::class;

    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'title' => $this->faker->words(2, true),
            'quantity' => $this->faker->numberBetween(1, 5),
            'unit_price' => $this->faker->numberBetween(100, 10000),
            'metadata' => null,
        ];
    }
}
