<?php

namespace JeffersonGoncalves\Commerce\Core\Tests\Fixtures;

use JeffersonGoncalves\Commerce\Core\Services\Service;

class ThingService extends Service
{
    protected function model(): string
    {
        return Thing::class;
    }
}
