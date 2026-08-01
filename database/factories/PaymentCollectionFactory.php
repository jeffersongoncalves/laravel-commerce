<?php

namespace JeffersonGoncalves\Commerce\Payment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Payment\Enums\PaymentCollectionStatus;
use JeffersonGoncalves\Commerce\Payment\Models\PaymentCollection;

/**
 * @extends Factory<PaymentCollection>
 */
class PaymentCollectionFactory extends Factory
{
    protected $model = PaymentCollection::class;

    public function definition(): array
    {
        return [
            'amount' => $this->faker->numberBetween(1000, 50000),
            'currency_code' => 'usd',
            'status' => PaymentCollectionStatus::NotPaid,
            'captured_amount' => 0,
            'refunded_amount' => 0,
            'metadata' => null,
        ];
    }
}
