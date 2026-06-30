<?php

namespace JeffersonGoncalves\Commerce\Fulfillment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Fulfillment\Database\Factories\ShippingOptionFactory;

/**
 * @property string $id
 * @property string $name
 * @property string $service_zone_id
 * @property string|null $provider_id
 * @property string $price_type
 * @property array<string, mixed>|null $data
 * @property array<string, mixed>|null $metadata
 */
class ShippingOption extends BaseModel
{
    /** @use HasFactory<ShippingOptionFactory> */
    use HasFactory;

    protected string $idPrefix = 'so';

    protected $table = 'commerce_shipping_options';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'data' => 'array',
            'metadata' => 'array',
        ];
    }

    /**
     * @return BelongsTo<ServiceZone, $this>
     */
    public function serviceZone(): BelongsTo
    {
        return $this->belongsTo(ServiceZone::class, 'service_zone_id');
    }

    protected static function newFactory(): ShippingOptionFactory
    {
        return ShippingOptionFactory::new();
    }
}
