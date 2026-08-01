<?php

use JeffersonGoncalves\Commerce\Payment\Enums\PaymentCollectionStatus;
use JeffersonGoncalves\Commerce\Payment\Models\Payment;
use JeffersonGoncalves\Commerce\Payment\Models\PaymentCollection;
use JeffersonGoncalves\Commerce\Payment\Models\Refund;
use JeffersonGoncalves\Commerce\Payment\Services\PaymentService;

it('creates a payment collection with a prefixed id and default status', function () {
    $collection = PaymentCollection::factory()->create();

    expect($collection->id)->toStartWith('paycol_')
        ->and($collection->status)->toBe(PaymentCollectionStatus::NotPaid);
});

it('relates payments and sessions to a collection', function () {
    $collection = PaymentCollection::factory()->create();
    Payment::factory()->count(2)->create(['payment_collection_id' => $collection->id]);

    expect($collection->payments)->toHaveCount(2)
        ->and($collection->payments->first()->id)->toStartWith('pay_');
});

it('captures a payment through the service', function () {
    $payment = Payment::factory()->create(['amount' => 5000]);

    $capture = (new PaymentService)->capture($payment->id, 3000);

    $payment->load('captures');

    expect($capture->id)->toStartWith('capt_')
        ->and($payment->capturedAmount())->toBe(3000)
        ->and($payment->fresh()->captured_at)->not->toBeNull();
});

it('tracks refunded amount', function () {
    $payment = Payment::factory()->create();
    Refund::factory()->create([
        'payment_id' => $payment->id,
        'amount' => 1200,
    ]);

    $payment->load('refunds');

    expect($payment->refundedAmount())->toBe(1200);
});
