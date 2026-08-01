<?php

namespace JeffersonGoncalves\Commerce\Customer\Services;

use JeffersonGoncalves\Commerce\Core\Services\Service;
use JeffersonGoncalves\Commerce\Customer\Models\Customer;

class CustomerService extends Service
{
    protected function model(): string
    {
        return Customer::class;
    }
}
