<?php

namespace JeffersonGoncalves\Commerce\Store\Services;

use JeffersonGoncalves\Commerce\Core\Services\Service;
use JeffersonGoncalves\Commerce\Store\Models\Store;

class StoreService extends Service
{
    protected function model(): string
    {
        return Store::class;
    }
}
