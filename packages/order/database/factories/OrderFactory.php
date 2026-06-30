<?php

namespace JeffersonGoncalves\Commerce\Order\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Order\Enums\OrderStatus;
use JeffersonGoncalves\Commerce\Order\Models\Order;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'display_id' => $this->faker->unique()->numberBetween(1, 100000),
            'email' => $this->faker->safeEmail(),
            'currency_code' => 'usd',
            'status' => OrderStatus::Pending,
            'metadata' => null,
        ];
    }
}
