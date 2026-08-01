<?php

namespace JeffersonGoncalves\Commerce\Store\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Store\Database\Factories\StoreFactory;

/**
 * @property string $id
 * @property string $name
 * @property string|null $default_currency_code
 * @property array<string, mixed>|null $metadata
 */
class Store extends BaseModel
{
    /** @use HasFactory<StoreFactory> */
    use HasFactory;

    protected string $idPrefix = 'store';

    protected $table = 'commerce_stores';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'metadata' => 'array',
        ];
    }

    protected static function newFactory(): StoreFactory
    {
        return StoreFactory::new();
    }
}
