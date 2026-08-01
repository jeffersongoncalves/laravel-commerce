<?php

use JeffersonGoncalves\Commerce\Currency\Database\Seeders\CurrencySeeder;
use JeffersonGoncalves\Commerce\Currency\Models\Currency;

it('seeds the common currencies idempotently', function () {
    (new CurrencySeeder)->run();
    (new CurrencySeeder)->run();

    expect(Currency::query()->count())->toBe(4)
        ->and(Currency::query()->find('brl')->symbol)->toBe('R$')
        ->and(Currency::query()->find('usd')->name)->toBe('US Dollar');
});
