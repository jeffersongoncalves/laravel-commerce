<?php

namespace JeffersonGoncalves\Commerce\Currency\Database\Seeders;

use Illuminate\Database\Seeder;
use JeffersonGoncalves\Commerce\Currency\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * @var list<array{code: string, symbol: string, symbol_native: string, name: string, decimal_digits: int, rounding: float}>
     */
    protected array $currencies = [
        ['code' => 'usd', 'symbol' => '$', 'symbol_native' => '$', 'name' => 'US Dollar', 'decimal_digits' => 2, 'rounding' => 0],
        ['code' => 'eur', 'symbol' => '€', 'symbol_native' => '€', 'name' => 'Euro', 'decimal_digits' => 2, 'rounding' => 0],
        ['code' => 'gbp', 'symbol' => '£', 'symbol_native' => '£', 'name' => 'British Pound', 'decimal_digits' => 2, 'rounding' => 0],
        ['code' => 'brl', 'symbol' => 'R$', 'symbol_native' => 'R$', 'name' => 'Brazilian Real', 'decimal_digits' => 2, 'rounding' => 0],
    ];

    public function run(): void
    {
        foreach ($this->currencies as $currency) {
            Currency::query()->updateOrCreate(['code' => $currency['code']], $currency);
        }
    }
}
