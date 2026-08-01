<?php

namespace JeffersonGoncalves\Commerce\Region\Services;

use JeffersonGoncalves\Commerce\Core\Services\Service;
use JeffersonGoncalves\Commerce\Region\Models\Region;

class RegionService extends Service
{
    protected function model(): string
    {
        return Region::class;
    }
}
