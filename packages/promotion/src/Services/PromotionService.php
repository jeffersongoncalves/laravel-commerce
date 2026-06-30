<?php

namespace JeffersonGoncalves\Commerce\Promotion\Services;

use JeffersonGoncalves\Commerce\Core\Services\Service;
use JeffersonGoncalves\Commerce\Promotion\Models\Promotion;

class PromotionService extends Service
{
    protected function model(): string
    {
        return Promotion::class;
    }
}
