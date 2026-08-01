<?php

namespace JeffersonGoncalves\Commerce\Core\Concerns;

use Illuminate\Support\Str;

/**
 * Gives a model a non-incrementing, ULID-based string primary key prefixed
 * with a short type token (e.g. "prod_01J...", "order_01J...").
 *
 * Implementing models expose the token through an `$idPrefix` property.
 */
trait HasPrefixedId
{
    public function initializeHasPrefixedId(): void
    {
        $this->incrementing = false;
        $this->keyType = 'string';
    }

    public static function bootHasPrefixedId(): void
    {
        static::creating(function ($model): void {
            $key = $model->getKeyName();

            if (empty($model->getAttribute($key))) {
                $model->setAttribute($key, $model->idPrefix().'_'.Str::ulid()->toBase32());
            }
        });
    }

    public function idPrefix(): string
    {
        return property_exists($this, 'idPrefix') ? $this->idPrefix : 'id';
    }
}
