<?php

namespace JeffersonGoncalves\Commerce\Payment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Payment\Models\Capture;
use JeffersonGoncalves\Commerce\Payment\Models\Payment;

/**
 * @extends Factory<Capture>
 */
class CaptureFactory extends Factory
{
    protected $model = Capture::class;

    public function definition(): array
    {
        return [
            'payment_id' => Payment::factory(),
            'amount' => $this->faker->numberBetween(100, 10000),
            'metadata' => null,
        ];
    }
}
