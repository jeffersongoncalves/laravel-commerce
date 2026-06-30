<?php

namespace JeffersonGoncalves\Commerce\Pricing\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Pricing\Database\Factories\PriceSetFactory;

/**
 * @property string $id
 * @property array<string, mixed>|null $metadata
 */
class PriceSet extends BaseModel
{
    /** @use HasFactory<PriceSetFactory> */
    use HasFactory;

    protected string $idPrefix = 'pset';

    protected $table = 'commerce_price_sets';

    protected $guarded = [];

    protected function casts(): array
    {
        return ['metadata' => 'array'];
    }

    /**
     * @return HasMany<Price, $this>
     */
    public function prices(): HasMany
    {
        return $this->hasMany(Price::class, 'price_set_id');
    }

    protected static function newFactory(): PriceSetFactory
    {
        return PriceSetFactory::new();
    }
}
