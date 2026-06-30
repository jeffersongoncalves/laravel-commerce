<?php

namespace JeffersonGoncalves\Commerce\Currency\Services;

use JeffersonGoncalves\Commerce\Core\Services\Service;
use JeffersonGoncalves\Commerce\Currency\Models\Currency;

class CurrencyService extends Service
{
    protected function model(): string
    {
        return Currency::class;
    }
}
