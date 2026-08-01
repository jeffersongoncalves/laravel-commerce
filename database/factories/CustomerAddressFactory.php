<?php

namespace JeffersonGoncalves\Commerce\Customer\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Customer\Models\Customer;
use JeffersonGoncalves\Commerce\Customer\Models\CustomerAddress;

/**
 * @extends Factory<CustomerAddress>
 */
class CustomerAddressFactory extends Factory
{
    protected $model = CustomerAddress::class;

    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'address_1' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'province' => $this->faker->stateAbbr(),
            'postal_code' => $this->faker->postcode(),
            'country_code' => strtolower($this->faker->countryCode()),
            'phone' => $this->faker->phoneNumber(),
            'is_default_shipping' => false,
            'is_default_billing' => false,
            'metadata' => null,
        ];
    }
}
