<?php

namespace JeffersonGoncalves\Commerce\Pricing\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Pricing\Database\Factories\PriceListFactory;
use JeffersonGoncalves\Commerce\Pricing\Enums\PriceListStatus;
use JeffersonGoncalves\Commerce\Pricing\Enums\PriceListType;

/**
 * @property string $id
 * @property string $title
 * @property string|null $description
 * @property PriceListStatus $status
 * @property PriceListType $type
 * @property Carbon|null $starts_at
 * @property Carbon|null $ends_at
 * @property array<string, mixed>|null $metadata
 */
class PriceList extends BaseModel
{
    /** @use HasFactory<PriceListFactory> */
    use HasFactory;

    protected string $idPrefix = 'plist';

    protected $table = 'commerce_price_lists';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'status' => PriceListStatus::class,
            'type' => PriceListType::class,
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    /**
     * @return HasMany<Price, $this>
     */
    public function prices(): HasMany
    {
        return $this->hasMany(Price::class, 'price_list_id');
    }

    protected static function newFactory(): PriceListFactory
    {
        return PriceListFactory::new();
    }
}
