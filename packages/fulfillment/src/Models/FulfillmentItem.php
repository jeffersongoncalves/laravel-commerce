<?php

namespace JeffersonGoncalves\Commerce\Fulfillment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Fulfillment\Database\Factories\FulfillmentItemFactory;

/**
 * @property string $id
 * @property string $fulfillment_id
 * @property string $title
 * @property int $quantity
 * @property string|null $line_item_id
 * @property string|null $inventory_item_id
 * @property array<string, mixed>|null $metadata
 */
class FulfillmentItem extends BaseModel
{
    /** @use HasFactory<FulfillmentItemFactory> */
    use HasFactory;

    protected string $idPrefix = 'fulitem';

    protected $table = 'commerce_fulfillment_items';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'metadata' => 'array',
        ];
    }

    /**
     * @return BelongsTo<Fulfillment, $this>
     */
    public function fulfillment(): BelongsTo
    {
        return $this->belongsTo(Fulfillment::class, 'fulfillment_id');
    }

    protected static function newFactory(): FulfillmentItemFactory
    {
        return FulfillmentItemFactory::new();
    }
}
