<?php

use JeffersonGoncalves\Commerce\Loyalty\Models\LoyaltyAccount;
use JeffersonGoncalves\Commerce\Loyalty\Services\LoyaltyService;

it('earns and redeems points, tracking the balance', function () {
    $account = LoyaltyAccount::factory()->create();
    $service = new LoyaltyService;

    $service->earn($account->id, 300);
    $service->earn($account->id, 200);
    $service->redeem($account->id, 100);

    expect($account->fresh()->balance())->toBe(400)
        ->and($account->id)->toStartWith('loyacc_');
});

it('refuses to redeem more than the balance', function () {
    $account = LoyaltyAccount::factory()->create();
    $service = new LoyaltyService;
    $service->earn($account->id, 50);

    $service->redeem($account->id, 100);
})->throws(RuntimeException::class);
