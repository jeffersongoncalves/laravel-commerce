<?php

namespace JeffersonGoncalves\Commerce\StockLocation\Services;

use JeffersonGoncalves\Commerce\Core\Services\Service;
use JeffersonGoncalves\Commerce\StockLocation\Models\StockLocation;

class StockLocationService extends Service
{
    protected function model(): string
    {
        return StockLocation::class;
    }
}
