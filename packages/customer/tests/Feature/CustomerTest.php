<?php

use JeffersonGoncalves\Commerce\Customer\Models\Customer;
use JeffersonGoncalves\Commerce\Customer\Models\CustomerAddress;
use JeffersonGoncalves\Commerce\Customer\Models\CustomerGroup;
use JeffersonGoncalves\Commerce\Customer\Services\CustomerService;

it('creates a customer with a prefixed id', function () {
    $customer = (new CustomerService)->create(['email' => 'jane@example.com']);

    expect($customer->id)->toStartWith('cus_');
});

it('has addresses', function () {
    $customer = Customer::factory()->create();
    CustomerAddress::factory()->count(2)->create(['customer_id' => $customer->id]);

    expect($customer->addresses)->toHaveCount(2)
        ->and($customer->addresses->first()->id)->toStartWith('cusaddr_');
});

it('belongs to customer groups', function () {
    $customer = Customer::factory()->create();
    $group = CustomerGroup::factory()->create();

    $customer->groups()->attach($group->id);

    expect($customer->groups)->toHaveCount(1)
        ->and($group->customers()->count())->toBe(1);
});
