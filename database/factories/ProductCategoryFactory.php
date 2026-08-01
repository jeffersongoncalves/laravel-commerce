<?php

namespace JeffersonGoncalves\Commerce\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Product\Models\ProductCategory;

/**
 * @extends Factory<ProductCategory>
 */
class ProductCategoryFactory extends Factory
{
    protected $model = ProductCategory::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'handle' => $this->faker->unique()->slug(),
            'description' => $this->faker->sentence(),
            'is_active' => true,
            'is_internal' => false,
            'rank' => 0,
            'metadata' => null,
        ];
    }
}
