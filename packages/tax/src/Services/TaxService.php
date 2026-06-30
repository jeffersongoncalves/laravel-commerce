<?php

namespace JeffersonGoncalves\Commerce\Tax\Services;

use JeffersonGoncalves\Commerce\Core\Services\Service;
use JeffersonGoncalves\Commerce\Tax\Models\TaxRate;

class TaxService extends Service
{
    protected function model(): string
    {
        return TaxRate::class;
    }
}
