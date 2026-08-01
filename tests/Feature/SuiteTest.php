<?php

use JeffersonGoncalves\Commerce\CommerceServiceProvider;

it('boots the commerce suite providers', function () {
    expect(app()->getProviders(CommerceServiceProvider::class))
        ->not->toBeEmpty();
});
