<?php

namespace JeffersonGoncalves\Commerce\Payment\Events;

use JeffersonGoncalves\Commerce\Payment\Models\Capture;
use JeffersonGoncalves\Commerce\Payment\Models\Payment;

class PaymentCaptured
{
    public function __construct(
        public readonly Payment $payment,
        public readonly Capture $capture,
    ) {}
}
