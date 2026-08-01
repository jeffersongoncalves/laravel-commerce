<?php

namespace JeffersonGoncalves\Commerce\Store\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Store\Models\Store;

/**
 * @extends Factory<Store>
 */
class StoreFactory extends Factory
{
    protected $model = Store::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'default_currency_code' => 'usd',
            'metadata' => null,
        ];
    }
}
