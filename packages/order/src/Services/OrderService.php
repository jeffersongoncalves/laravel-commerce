<?php

namespace JeffersonGoncalves\Commerce\Order\Services;

use JeffersonGoncalves\Commerce\Core\Services\Service;
use JeffersonGoncalves\Commerce\Order\Models\Order;

class OrderService extends Service
{
    protected function model(): string
    {
        return Order::class;
    }
}
