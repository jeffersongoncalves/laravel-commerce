<?php

use JeffersonGoncalves\Commerce\Currency\Models\Currency;
use JeffersonGoncalves\Commerce\Currency\Services\CurrencyService;

it('creates a currency keyed by its code', function () {
    $currency = (new CurrencyService)->create([
        'code' => 'usd',
        'symbol' => '$',
        'symbol_native' => '$',
        'name' => 'US Dollar',
        'decimal_digits' => 2,
        'rounding' => 0,
    ]);

    expect($currency->code)->toBe('usd')
        ->and($currency->decimal_digits)->toBe(2);

    expect(Currency::query()->find('usd'))->not->toBeNull();
});

it('builds currencies from the factory', function () {
    $currency = Currency::factory()->create();

    expect($currency->code)->not->toBeEmpty();
});
