<?php

namespace JeffersonGoncalves\Commerce\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Product\Enums\ProductStatus;
use JeffersonGoncalves\Commerce\Product\Models\Product;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $title = $this->faker->words(3, true);

        return [
            'title' => $title,
            'handle' => $this->faker->unique()->slug(),
            'description' => $this->faker->sentence(),
            'status' => ProductStatus::Draft,
            'is_giftcard' => false,
            'discountable' => true,
            'metadata' => null,
        ];
    }

    public function published(): static
    {
        return $this->state(fn () => ['status' => ProductStatus::Published]);
    }
}
