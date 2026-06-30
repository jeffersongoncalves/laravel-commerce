<?php

namespace JeffersonGoncalves\Commerce\Order\Events;

use JeffersonGoncalves\Commerce\Order\Models\Order;

class OrderPlaced
{
    public function __construct(
        public readonly Order $order,
    ) {}
}
