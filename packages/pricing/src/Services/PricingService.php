<?php

namespace JeffersonGoncalves\Commerce\Pricing\Services;

use JeffersonGoncalves\Commerce\Core\Services\Service;
use JeffersonGoncalves\Commerce\Pricing\Models\Price;

class PricingService extends Service
{
    protected function model(): string
    {
        return Price::class;
    }
}
