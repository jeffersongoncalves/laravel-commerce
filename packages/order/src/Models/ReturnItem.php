<?php

namespace JeffersonGoncalves\Commerce\Order\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;

/**
 * @property string $id
 * @property string $return_id
 * @property string $order_line_item_id
 * @property int $quantity
 * @property array<string, mixed>|null $metadata
 */
class ReturnItem extends BaseModel
{
    protected string $idPrefix = 'retitem';

    protected $table = 'commerce_return_items';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'metadata' => 'array',
        ];
    }

    /**
     * @return BelongsTo<OrderReturn, $this>
     */
    public function return(): BelongsTo
    {
        return $this->belongsTo(OrderReturn::class, 'return_id');
    }

    /**
     * @return BelongsTo<OrderLineItem, $this>
     */
    public function orderLineItem(): BelongsTo
    {
        return $this->belongsTo(OrderLineItem::class, 'order_line_item_id');
    }
}
