<?php

use JeffersonGoncalves\Commerce\Core\Support\Money;
use JeffersonGoncalves\Commerce\Pricing\Models\Price;
use JeffersonGoncalves\Commerce\Pricing\Models\PriceList;
use JeffersonGoncalves\Commerce\Pricing\Models\PriceRule;
use JeffersonGoncalves\Commerce\Pricing\Models\PriceSet;

it('creates a price under a price set with a prefixed id', function () {
    $set = PriceSet::factory()->create();
    $price = Price::factory()->create([
        'price_set_id' => $set->id,
        'amount' => 2500,
        'currency_code' => 'usd',
    ]);

    expect($price->id)->toStartWith('price_')
        ->and($set->prices)->toHaveCount(1);
});

it('exposes the amount as a money value object', function () {
    $price = Price::factory()->create(['amount' => 1999, 'currency_code' => 'eur']);

    expect($price->money())->toBeInstanceOf(Money::class)
        ->and($price->money()->amount)->toBe(1999)
        ->and($price->money()->currency)->toBe('eur');
});

it('groups prices under a price list', function () {
    $list = PriceList::factory()->create();
    Price::factory()->count(2)->create(['price_list_id' => $list->id]);

    expect($list->prices)->toHaveCount(2);
});

it('attaches rules to a price', function () {
    $price = Price::factory()->create();
    PriceRule::factory()->create([
        'price_id' => $price->id,
        'attribute' => 'region_id',
        'value' => 'reg_eu',
    ]);

    expect($price->rules)->toHaveCount(1)
        ->and($price->rules->first()->attribute)->toBe('region_id');
});
