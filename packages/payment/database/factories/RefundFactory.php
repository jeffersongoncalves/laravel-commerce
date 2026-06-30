<?php

namespace JeffersonGoncalves\Commerce\Payment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Payment\Models\Payment;
use JeffersonGoncalves\Commerce\Payment\Models\Refund;

/**
 * @extends Factory<Refund>
 */
class RefundFactory extends Factory
{
    protected $model = Refund::class;

    public function definition(): array
    {
        return [
            'payment_id' => Payment::factory(),
            'amount' => $this->faker->numberBetween(100, 10000),
            'reason' => $this->faker->randomElement(['return', 'discount', 'other']),
            'metadata' => null,
        ];
    }
}
