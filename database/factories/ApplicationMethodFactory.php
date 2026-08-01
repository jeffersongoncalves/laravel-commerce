<?php

namespace JeffersonGoncalves\Commerce\Promotion\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Promotion\Enums\ApplicationMethodType;
use JeffersonGoncalves\Commerce\Promotion\Models\ApplicationMethod;
use JeffersonGoncalves\Commerce\Promotion\Models\Promotion;

/**
 * @extends Factory<ApplicationMethod>
 */
class ApplicationMethodFactory extends Factory
{
    protected $model = ApplicationMethod::class;

    public function definition(): array
    {
        return [
            'promotion_id' => Promotion::factory(),
            'type' => ApplicationMethodType::Percentage,
            'target_type' => 'items',
            'value' => $this->faker->numberBetween(5, 50),
            'currency_code' => null,
            'metadata' => null,
        ];
    }
}
