<?php

namespace JeffersonGoncalves\Commerce\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Product\Models\Product;
use JeffersonGoncalves\Commerce\Product\Models\ProductOption;

/**
 * @extends Factory<ProductOption>
 */
class ProductOptionFactory extends Factory
{
    protected $model = ProductOption::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->randomElement(['Size', 'Color', 'Material']),
            'product_id' => Product::factory(),
            'metadata' => null,
        ];
    }
}
