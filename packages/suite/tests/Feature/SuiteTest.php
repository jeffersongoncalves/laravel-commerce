<?php

use JeffersonGoncalves\Commerce\Suite\CommerceServiceProvider;

it('boots the commerce suite providers', function () {
    expect(app()->getProviders(CommerceServiceProvider::class))
        ->not->toBeEmpty();
});
