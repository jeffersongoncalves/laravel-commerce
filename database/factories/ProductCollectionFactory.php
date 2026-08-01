<?php

namespace JeffersonGoncalves\Commerce\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Product\Models\ProductCollection;

/**
 * @extends Factory<ProductCollection>
 */
class ProductCollectionFactory extends Factory
{
    protected $model = ProductCollection::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->words(2, true),
            'handle' => $this->faker->unique()->slug(),
            'metadata' => null,
        ];
    }
}
