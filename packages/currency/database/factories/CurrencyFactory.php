<?php

namespace JeffersonGoncalves\Commerce\Currency\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Currency\Models\Currency;

/**
 * @extends Factory<Currency>
 */
class CurrencyFactory extends Factory
{
    protected $model = Currency::class;

    public function definition(): array
    {
        $code = strtolower($this->faker->unique()->currencyCode());

        return [
            'code' => $code,
            'symbol' => '$',
            'symbol_native' => '$',
            'name' => $this->faker->word().' Currency',
            'decimal_digits' => 2,
            'rounding' => 0,
        ];
    }
}
