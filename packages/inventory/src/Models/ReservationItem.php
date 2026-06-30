<?php

namespace JeffersonGoncalves\Commerce\Inventory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Inventory\Database\Factories\ReservationItemFactory;

/**
 * @property string $id
 * @property string $inventory_item_id
 * @property string $location_id
 * @property int $quantity
 * @property string|null $line_item_id
 * @property string|null $description
 * @property array<string, mixed>|null $metadata
 */
class ReservationItem extends BaseModel
{
    /** @use HasFactory<ReservationItemFactory> */
    use HasFactory;

    protected string $idPrefix = 'resitem';

    protected $table = 'commerce_reservation_items';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'metadata' => 'array',
        ];
    }

    /**
     * @return BelongsTo<InventoryItem, $this>
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(InventoryItem::class, 'inventory_item_id');
    }

    protected static function newFactory(): ReservationItemFactory
    {
        return ReservationItemFactory::new();
    }
}
