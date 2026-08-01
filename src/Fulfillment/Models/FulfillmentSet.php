<?php

namespace JeffersonGoncalves\Commerce\Fulfillment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Fulfillment\Database\Factories\FulfillmentSetFactory;

/**
 * @property string $id
 * @property string $name
 * @property string $type
 * @property array<string, mixed>|null $metadata
 */
class FulfillmentSet extends BaseModel
{
    /** @use HasFactory<FulfillmentSetFactory> */
    use HasFactory;

    protected string $idPrefix = 'fuset';

    protected $table = 'commerce_fulfillment_sets';

    protected $guarded = [];

    protected function casts(): array
    {
        return ['metadata' => 'array'];
    }

    /**
     * @return HasMany<ServiceZone, $this>
     */
    public function serviceZones(): HasMany
    {
        return $this->hasMany(ServiceZone::class, 'fulfillment_set_id');
    }

    protected static function newFactory(): FulfillmentSetFactory
    {
        return FulfillmentSetFactory::new();
    }
}
