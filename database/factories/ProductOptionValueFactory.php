<?php

namespace JeffersonGoncalves\Commerce\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Product\Models\ProductOption;
use JeffersonGoncalves\Commerce\Product\Models\ProductOptionValue;

/**
 * @extends Factory<ProductOptionValue>
 */
class ProductOptionValueFactory extends Factory
{
    protected $model = ProductOptionValue::class;

    public function definition(): array
    {
        return [
            'value' => $this->faker->word(),
            'option_id' => ProductOption::factory(),
            'metadata' => null,
        ];
    }
}
