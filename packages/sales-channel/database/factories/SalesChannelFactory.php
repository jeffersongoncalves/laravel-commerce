<?php

namespace JeffersonGoncalves\Commerce\SalesChannel\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\SalesChannel\Models\SalesChannel;

/**
 * @extends Factory<SalesChannel>
 */
class SalesChannelFactory extends Factory
{
    protected $model = SalesChannel::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(),
            'is_disabled' => false,
            'metadata' => null,
        ];
    }
}
