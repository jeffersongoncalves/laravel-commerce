<?php

namespace JeffersonGoncalves\Commerce\Cart\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Cart\Models\Cart;

/**
 * @extends Factory<Cart>
 */
class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition(): array
    {
        return [
            'email' => $this->faker->safeEmail(),
            'currency_code' => 'usd',
            'metadata' => null,
        ];
    }
}
