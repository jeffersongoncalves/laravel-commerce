<?php

namespace JeffersonGoncalves\Commerce\Cart\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Cart\Models\Cart;
use JeffersonGoncalves\Commerce\Cart\Models\CartLineItem;

/**
 * @extends Factory<CartLineItem>
 */
class CartLineItemFactory extends Factory
{
    protected $model = CartLineItem::class;

    public function definition(): array
    {
        return [
            'cart_id' => Cart::factory(),
            'title' => $this->faker->words(2, true),
            'quantity' => $this->faker->numberBetween(1, 5),
            'unit_price' => $this->faker->numberBetween(100, 10000),
            'metadata' => null,
        ];
    }
}
