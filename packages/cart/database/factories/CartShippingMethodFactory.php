<?php

namespace JeffersonGoncalves\Commerce\Cart\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Cart\Models\Cart;
use JeffersonGoncalves\Commerce\Cart\Models\CartShippingMethod;

/**
 * @extends Factory<CartShippingMethod>
 */
class CartShippingMethodFactory extends Factory
{
    protected $model = CartShippingMethod::class;

    public function definition(): array
    {
        return [
            'cart_id' => Cart::factory(),
            'name' => $this->faker->randomElement(['Standard', 'Express']),
            'amount' => $this->faker->numberBetween(0, 2000),
            'shipping_option_id' => null,
            'data' => null,
            'metadata' => null,
        ];
    }
}
