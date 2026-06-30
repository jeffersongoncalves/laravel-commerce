<?php

use JeffersonGoncalves\Commerce\Auth\Models\AuthIdentity;
use JeffersonGoncalves\Commerce\Auth\Models\ProviderIdentity;

it('creates an auth identity with a prefixed id', function () {
    $identity = AuthIdentity::factory()->create();

    expect($identity->id)->toStartWith('authid_');
});

it('links provider identities to an auth identity', function () {
    $identity = AuthIdentity::factory()->create();
    ProviderIdentity::factory()->create([
        'auth_identity_id' => $identity->id,
        'provider' => 'emailpass',
    ]);

    expect($identity->providerIdentities)->toHaveCount(1)
        ->and($identity->providerIdentities->first()->id)->toStartWith('provid_')
        ->and($identity->providerIdentities->first()->authIdentity->id)->toBe($identity->id);
});
