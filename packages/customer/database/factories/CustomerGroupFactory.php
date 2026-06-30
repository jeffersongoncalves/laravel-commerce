<?php

namespace JeffersonGoncalves\Commerce\Customer\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Customer\Models\CustomerGroup;

/**
 * @extends Factory<CustomerGroup>
 */
class CustomerGroupFactory extends Factory
{
    protected $model = CustomerGroup::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'metadata' => null,
        ];
    }
}
