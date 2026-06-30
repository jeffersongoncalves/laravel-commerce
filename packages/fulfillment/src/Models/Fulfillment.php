<?php

namespace JeffersonGoncalves\Commerce\Fulfillment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Fulfillment\Database\Factories\FulfillmentFactory;

/**
 * @property string $id
 * @property string|null $location_id
 * @property string|null $provider_id
 * @property string|null $shipping_option_id
 * @property Carbon|null $packed_at
 * @property Carbon|null $shipped_at
 * @property Carbon|null $delivered_at
 * @property array<string, mixed>|null $metadata
 */
class Fulfillment extends BaseModel
{
    /** @use HasFactory<FulfillmentFactory> */
    use HasFactory;

    protected string $idPrefix = 'ful';

    protected $table = 'commerce_fulfillments';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'packed_at' => 'datetime',
            'shipped_at' => 'datetime',
            'delivered_at' => 'datetime',
            'canceled_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    /**
     * @return HasMany<FulfillmentItem, $this>
     */
    public function items(): HasMany
    {
        return $this->hasMany(FulfillmentItem::class, 'fulfillment_id');
    }

    protected static function newFactory(): FulfillmentFactory
    {
        return FulfillmentFactory::new();
    }
}
