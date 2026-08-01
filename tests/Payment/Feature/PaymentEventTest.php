<?php

use Illuminate\Support\Facades\Event;
use JeffersonGoncalves\Commerce\Payment\Events\PaymentCaptured;
use JeffersonGoncalves\Commerce\Payment\Models\Payment;
use JeffersonGoncalves\Commerce\Payment\Services\PaymentService;

it('dispatches PaymentCaptured when a payment is captured', function () {
    Event::fake([PaymentCaptured::class]);

    $payment = Payment::factory()->create(['amount' => 5000]);

    (new PaymentService)->capture($payment->id, 3000);

    Event::assertDispatched(PaymentCaptured::class);
});
