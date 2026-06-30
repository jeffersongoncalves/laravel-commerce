<?php

namespace JeffersonGoncalves\Commerce\Promotion\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Promotion\Enums\PromotionStatus;
use JeffersonGoncalves\Commerce\Promotion\Enums\PromotionType;
use JeffersonGoncalves\Commerce\Promotion\Models\Promotion;

/**
 * @extends Factory<Promotion>
 */
class PromotionFactory extends Factory
{
    protected $model = Promotion::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->bothify('SAVE####'),
            'is_automatic' => false,
            'type' => PromotionType::Standard,
            'status' => PromotionStatus::Draft,
            'metadata' => null,
        ];
    }
}
