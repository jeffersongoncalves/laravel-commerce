<?php

namespace JeffersonGoncalves\Commerce\Inventory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Inventory\Database\Factories\InventoryItemFactory;

/**
 * @property string $id
 * @property string|null $sku
 * @property string|null $title
 * @property bool $requires_shipping
 * @property array<string, mixed>|null $metadata
 */
class InventoryItem extends BaseModel
{
    /** @use HasFactory<InventoryItemFactory> */
    use HasFactory;

    protected string $idPrefix = 'iitem';

    protected $table = 'commerce_inventory_items';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'weight' => 'float',
            'requires_shipping' => 'boolean',
            'metadata' => 'array',
        ];
    }

    /**
     * @return HasMany<InventoryLevel, $this>
     */
    public function levels(): HasMany
    {
        return $this->hasMany(InventoryLevel::class, 'inventory_item_id');
    }

    /**
     * @return HasMany<ReservationItem, $this>
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(ReservationItem::class, 'inventory_item_id');
    }

    protected static function newFactory(): InventoryItemFactory
    {
        return InventoryItemFactory::new();
    }
}
