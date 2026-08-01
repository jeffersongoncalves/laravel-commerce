<?php

namespace JeffersonGoncalves\Commerce\Fulfillment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Fulfillment\Database\Factories\ServiceZoneFactory;

/**
 * @property string $id
 * @property string $name
 * @property string $fulfillment_set_id
 * @property array<string, mixed>|null $metadata
 */
class ServiceZone extends BaseModel
{
    /** @use HasFactory<ServiceZoneFactory> */
    use HasFactory;

    protected string $idPrefix = 'serzo';

    protected $table = 'commerce_service_zones';

    protected $guarded = [];

    protected function casts(): array
    {
        return ['metadata' => 'array'];
    }

    /**
     * @return BelongsTo<FulfillmentSet, $this>
     */
    public function fulfillmentSet(): BelongsTo
    {
        return $this->belongsTo(FulfillmentSet::class, 'fulfillment_set_id');
    }

    /**
     * @return HasMany<ShippingOption, $this>
     */
    public function shippingOptions(): HasMany
    {
        return $this->hasMany(ShippingOption::class, 'service_zone_id');
    }

    protected static function newFactory(): ServiceZoneFactory
    {
        return ServiceZoneFactory::new();
    }
}
