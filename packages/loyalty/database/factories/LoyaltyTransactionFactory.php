<?php

namespace JeffersonGoncalves\Commerce\Loyalty\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Loyalty\Enums\LoyaltyTransactionType;
use JeffersonGoncalves\Commerce\Loyalty\Models\LoyaltyAccount;
use JeffersonGoncalves\Commerce\Loyalty\Models\LoyaltyTransaction;

/**
 * @extends Factory<LoyaltyTransaction>
 */
class LoyaltyTransactionFactory extends Factory
{
    protected $model = LoyaltyTransaction::class;

    public function definition(): array
    {
        return [
            'loyalty_account_id' => LoyaltyAccount::factory(),
            'points' => $this->faker->numberBetween(1, 500),
            'type' => LoyaltyTransactionType::Earn,
            'reference' => null,
            'metadata' => null,
        ];
    }
}
