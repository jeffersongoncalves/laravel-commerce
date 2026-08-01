<?php

use JeffersonGoncalves\Commerce\ApiKey\Enums\ApiKeyType;
use JeffersonGoncalves\Commerce\ApiKey\Models\ApiKey;
use JeffersonGoncalves\Commerce\ApiKey\Services\ApiKeyService;

it('creates a publishable api key with a prefixed id', function () {
    $key = ApiKey::factory()->create();

    expect($key->id)->toStartWith('apk_')
        ->and($key->type)->toBe(ApiKeyType::Publishable)
        ->and($key->isRevoked())->toBeFalse();
});

it('revokes a key', function () {
    $key = ApiKey::factory()->create();

    $revoked = (new ApiKeyService)->revoke($key->id);

    expect($revoked->isRevoked())->toBeTrue();
});
