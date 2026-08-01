<?php

use JeffersonGoncalves\Commerce\Core\Tests\Fixtures\Thing;

it('assigns a prefixed ulid id on create', function () {
    $thing = Thing::create(['name' => 'Widget']);

    expect($thing->id)->toStartWith('thing_')
        ->and(strlen($thing->id))->toBe(32); // "thing_" (6) + 26-char ulid
});

it('persists money through the cast', function () {
    $thing = Thing::create([
        'name' => 'Priced',
        'price' => ['amount' => 2500, 'currency' => 'usd'],
    ]);

    $fresh = Thing::findOrFail($thing->id);

    expect($fresh->price->amount)->toBe(2500)
        ->and($fresh->price->currency)->toBe('usd');
});
