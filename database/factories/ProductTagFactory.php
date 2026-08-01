<?php

namespace JeffersonGoncalves\Commerce\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Product\Models\ProductTag;

/**
 * @extends Factory<ProductTag>
 */
class ProductTagFactory extends Factory
{
    protected $model = ProductTag::class;

    public function definition(): array
    {
        return [
            'value' => $this->faker->unique()->word(),
            'metadata' => null,
        ];
    }
}
