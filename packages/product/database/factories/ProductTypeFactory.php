<?php

namespace JeffersonGoncalves\Commerce\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Product\Models\ProductType;

/**
 * @extends Factory<ProductType>
 */
class ProductTypeFactory extends Factory
{
    protected $model = ProductType::class;

    public function definition(): array
    {
        return [
            'value' => $this->faker->unique()->word(),
            'metadata' => null,
        ];
    }
}
