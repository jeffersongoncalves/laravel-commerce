<?php

namespace JeffersonGoncalves\Commerce\Payment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Payment\Models\Payment;
use JeffersonGoncalves\Commerce\Payment\Models\PaymentCollection;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'payment_collection_id' => PaymentCollection::factory(),
            'amount' => $this->faker->numberBetween(1000, 50000),
            'currency_code' => 'usd',
            'provider_id' => 'pp_system_default',
            'metadata' => null,
        ];
    }
}
