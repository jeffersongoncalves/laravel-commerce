<?php

namespace JeffersonGoncalves\Commerce\StockLocation\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\StockLocation\Models\StockLocation;

/**
 * @extends Factory<StockLocation>
 */
class StockLocationFactory extends Factory
{
    protected $model = StockLocation::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company().' Warehouse',
            'address' => [
                'address_1' => $this->faker->streetAddress(),
                'city' => $this->faker->city(),
                'country_code' => strtolower($this->faker->countryCode()),
                'postal_code' => $this->faker->postcode(),
            ],
            'metadata' => null,
        ];
    }
}
