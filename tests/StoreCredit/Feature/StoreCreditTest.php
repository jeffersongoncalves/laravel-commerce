<?php

use JeffersonGoncalves\Commerce\StoreCredit\Models\StoreCreditAccount;
use JeffersonGoncalves\Commerce\StoreCredit\Services\StoreCreditService;

it('credits and debits, tracking the balance', function () {
    $account = StoreCreditAccount::factory()->create();
    $service = new StoreCreditService;

    $service->credit($account->id, 5000);
    $service->debit($account->id, 1500);

    expect($account->fresh()->balance())->toBe(3500)
        ->and($account->id)->toStartWith('scacc_');
});

it('refuses to debit beyond the balance', function () {
    $account = StoreCreditAccount::factory()->create();
    (new StoreCreditService)->debit($account->id, 100);
})->throws(RuntimeException::class);
