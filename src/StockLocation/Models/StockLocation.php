<?php

namespace JeffersonGoncalves\Commerce\StockLocation\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\StockLocation\Database\Factories\StockLocationFactory;

/**
 * @property string $id
 * @property string $name
 * @property array<string, mixed>|null $address
 * @property array<string, mixed>|null $metadata
 */
class StockLocation extends BaseModel
{
    /** @use HasFactory<StockLocationFactory> */
    use HasFactory;

    protected string $idPrefix = 'sloc';

    protected $table = 'commerce_stock_locations';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'address' => 'array',
            'metadata' => 'array',
        ];
    }

    protected static function newFactory(): StockLocationFactory
    {
        return StockLocationFactory::new();
    }
}
