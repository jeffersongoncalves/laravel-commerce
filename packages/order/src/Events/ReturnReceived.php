<?php

namespace JeffersonGoncalves\Commerce\Order\Events;

use JeffersonGoncalves\Commerce\Order\Models\OrderReturn;

class ReturnReceived
{
    public function __construct(
        public readonly OrderReturn $return,
    ) {}
}
