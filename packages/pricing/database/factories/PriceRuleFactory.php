<?php

namespace JeffersonGoncalves\Commerce\Pricing\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Pricing\Models\Price;
use JeffersonGoncalves\Commerce\Pricing\Models\PriceRule;

/**
 * @extends Factory<PriceRule>
 */
class PriceRuleFactory extends Factory
{
    protected $model = PriceRule::class;

    public function definition(): array
    {
        return [
            'price_id' => Price::factory(),
            'attribute' => 'region_id',
            'operator' => 'eq',
            'value' => 'reg_'.$this->faker->lexify('??????'),
            'priority' => 0,
            'metadata' => null,
        ];
    }
}
