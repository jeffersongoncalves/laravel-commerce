<?php

namespace JeffersonGoncalves\Commerce\StoreCredit\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\StoreCredit\Models\StoreCreditAccount;

/**
 * @extends Factory<StoreCreditAccount>
 */
class StoreCreditAccountFactory extends Factory
{
    protected $model = StoreCreditAccount::class;

    public function definition(): array
    {
        return [
            'customer_id' => 'cus_'.$this->faker->unique()->lexify('??????'),
            'currency_code' => 'usd',
            'metadata' => null,
        ];
    }
}
