<?php

namespace JeffersonGoncalves\Commerce\Core\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\Commerce\Core\Support\Money;

/**
 * Casts a JSON column holding {"amount": int, "currency": string} to a Money
 * value object and back.
 *
 * @implements CastsAttributes<Money, Money|array{amount: int|string, currency: string}>
 */
class MoneyCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): ?Money
    {
        if ($value === null) {
            return null;
        }

        $decoded = is_array($value) ? $value : json_decode((string) $value, true);

        if (! is_array($decoded)) {
            return null;
        }

        return Money::fromArray($decoded);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        if ($value === null) {
            return null;
        }

        $money = $value instanceof Money ? $value : Money::fromArray($value);

        return json_encode($money->toArray());
    }
}
