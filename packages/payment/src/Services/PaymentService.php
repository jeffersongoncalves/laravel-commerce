<?php

namespace JeffersonGoncalves\Commerce\Payment\Services;

use JeffersonGoncalves\Commerce\Core\Services\Service;
use JeffersonGoncalves\Commerce\Payment\Events\PaymentCaptured;
use JeffersonGoncalves\Commerce\Payment\Models\Capture;
use JeffersonGoncalves\Commerce\Payment\Models\Payment;

class PaymentService extends Service
{
    protected function model(): string
    {
        return Payment::class;
    }

    public function capture(string $paymentId, int $amount): Capture
    {
        /** @var Payment $payment */
        $payment = $this->retrieve($paymentId);

        $capture = $payment->captures()->create(['amount' => $amount]);

        if ($payment->captured_at === null) {
            $payment->update(['captured_at' => now()]);
        }

        event(new PaymentCaptured($payment, $capture));

        return $capture;
    }
}
