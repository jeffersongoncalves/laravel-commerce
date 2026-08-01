<?php

namespace JeffersonGoncalves\Commerce\Payment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Payment\Models\PaymentCollection;
use JeffersonGoncalves\Commerce\Payment\Models\PaymentSession;

/**
 * @extends Factory<PaymentSession>
 */
class PaymentSessionFactory extends Factory
{
    protected $model = PaymentSession::class;

    public function definition(): array
    {
        return [
            'payment_collection_id' => PaymentCollection::factory(),
            'amount' => $this->faker->numberBetween(1000, 50000),
            'currency_code' => 'usd',
            'provider_id' => 'pp_system_default',
            'status' => 'pending',
            'data' => null,
            'metadata' => null,
        ];
    }
}
