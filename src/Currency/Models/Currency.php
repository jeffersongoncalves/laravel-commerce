<?php

namespace JeffersonGoncalves\Commerce\Currency\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\Commerce\Currency\Database\Factories\CurrencyFactory;

/**
 * @property string $code
 * @property string $symbol
 * @property string $symbol_native
 * @property string $name
 * @property int $decimal_digits
 * @property float $rounding
 */
class Currency extends Model
{
    /** @use HasFactory<CurrencyFactory> */
    use HasFactory;

    protected $table = 'commerce_currencies';

    protected $primaryKey = 'code';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'decimal_digits' => 'integer',
            'rounding' => 'float',
        ];
    }

    protected static function newFactory(): CurrencyFactory
    {
        return CurrencyFactory::new();
    }
}
