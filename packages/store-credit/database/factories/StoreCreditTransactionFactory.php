<?php

namespace JeffersonGoncalves\Commerce\StoreCredit\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\StoreCredit\Models\StoreCreditAccount;
use JeffersonGoncalves\Commerce\StoreCredit\Models\StoreCreditTransaction;

/**
 * @extends Factory<StoreCreditTransaction>
 */
class StoreCreditTransactionFactory extends Factory
{
    protected $model = StoreCreditTransaction::class;

    public function definition(): array
    {
        return [
            'store_credit_account_id' => StoreCreditAccount::factory(),
            'amount' => $this->faker->numberBetween(100, 10000),
            'reference' => null,
            'metadata' => null,
        ];
    }
}
