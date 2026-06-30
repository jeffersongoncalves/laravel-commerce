<?php

namespace JeffersonGoncalves\Commerce\Promotion\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Promotion\Models\Promotion;
use JeffersonGoncalves\Commerce\Promotion\Models\PromotionRule;

/**
 * @extends Factory<PromotionRule>
 */
class PromotionRuleFactory extends Factory
{
    protected $model = PromotionRule::class;

    public function definition(): array
    {
        return [
            'promotion_id' => Promotion::factory(),
            'attribute' => 'customer_group_id',
            'operator' => 'in',
            'value' => 'cusgroup_'.$this->faker->lexify('??????'),
            'metadata' => null,
        ];
    }
}
