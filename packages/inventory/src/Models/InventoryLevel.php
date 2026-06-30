<?php

namespace JeffersonGoncalves\Commerce\Inventory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Inventory\Database\Factories\InventoryLevelFactory;

/**
 * @property string $id
 * @property string $inventory_item_id
 * @property string $location_id
 * @property int $stocked_quantity
 * @property int $reserved_quantity
 * @property int $incoming_quantity
 * @property array<string, mixed>|null $metadata
 */
class InventoryLevel extends BaseModel
{
    /** @use HasFactory<InventoryLevelFactory> */
    use HasFactory;

    protected string $idPrefix = 'ilev';

    protected $table = 'commerce_inventory_levels';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'stocked_quantity' => 'integer',
            'reserved_quantity' => 'integer',
            'incoming_quantity' => 'integer',
            'metadata' => 'array',
        ];
    }

    public function availableQuantity(): int
    {
        return $this->stocked_quantity - $this->reserved_quantity;
    }

    /**
     * @return BelongsTo<InventoryItem, $this>
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(InventoryItem::class, 'inventory_item_id');
    }

    protected static function newFactory(): InventoryLevelFactory
    {
        return InventoryLevelFactory::new();
    }
}
