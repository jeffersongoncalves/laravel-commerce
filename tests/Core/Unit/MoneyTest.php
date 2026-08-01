<?php

use JeffersonGoncalves\Commerce\Core\Support\Money;

it('stores amount and lowercased currency', function () {
    $money = Money::of(1500, 'USD');

    expect($money->amount)->toBe(1500)
        ->and($money->currency)->toBe('usd');
});

it('adds and subtracts within the same currency', function () {
    $a = Money::of(1500, 'usd');
    $b = Money::of(500, 'usd');

    expect($a->add($b)->amount)->toBe(2000)
        ->and($a->subtract($b)->amount)->toBe(1000);
});

it('rejects mixing currencies', function () {
    Money::of(100, 'usd')->add(Money::of(100, 'eur'));
})->throws(InvalidArgumentException::class);

it('round-trips through an array', function () {
    $money = Money::fromArray(['amount' => 999, 'currency' => 'brl']);

    expect($money->toArray())->toBe(['amount' => 999, 'currency' => 'brl']);
});
