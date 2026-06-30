<?php

namespace JeffersonGoncalves\Commerce\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Product\Models\Product;
use JeffersonGoncalves\Commerce\Product\Models\ProductImage;

/**
 * @extends Factory<ProductImage>
 */
class ProductImageFactory extends Factory
{
    protected $model = ProductImage::class;

    public function definition(): array
    {
        return [
            'url' => $this->faker->imageUrl(),
            'rank' => 0,
            'product_id' => Product::factory(),
            'metadata' => null,
        ];
    }
}
