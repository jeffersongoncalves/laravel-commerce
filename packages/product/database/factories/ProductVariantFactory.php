<?php

namespace JeffersonGoncalves\Commerce\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Product\Models\Product;
use JeffersonGoncalves\Commerce\Product\Models\ProductVariant;

/**
 * @extends Factory<ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    protected $model = ProductVariant::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'sku' => $this->faker->unique()->bothify('SKU-####-???'),
            'manage_inventory' => true,
            'allow_backorder' => false,
            'variant_rank' => 0,
            'product_id' => Product::factory(),
            'metadata' => null,
        ];
    }
}
