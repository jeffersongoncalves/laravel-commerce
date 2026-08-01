<?php

namespace JeffersonGoncalves\Commerce\Loyalty\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Loyalty\Models\LoyaltyAccount;

/**
 * @extends Factory<LoyaltyAccount>
 */
class LoyaltyAccountFactory extends Factory
{
    protected $model = LoyaltyAccount::class;

    public function definition(): array
    {
        return [
            'customer_id' => 'cus_'.$this->faker->unique()->lexify('??????'),
            'metadata' => null,
        ];
    }
}
