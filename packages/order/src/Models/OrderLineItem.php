<?php

namespace JeffersonGoncalves\Commerce\Order\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Order\Database\Factories\OrderLineItemFactory;

/**
 * @property string $id
 * @property string $order_id
 * @property string $title
 * @property int $quantity
 * @property int $unit_price
 * @property string|null $product_id
 * @property string|null $variant_id
 * @property array<string, mixed>|null $metadata
 */
class OrderLineItem extends BaseModel
{
    /** @use HasFactory<OrderLineItemFactory> */
    use HasFactory;

    protected string $idPrefix = 'orderitem';

    protected $table = 'commerce_order_line_items';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'unit_price' => 'integer',
            'metadata' => 'array',
        ];
    }

    public function subtotal(): int
    {
        return $this->quantity * $this->unit_price;
    }

    /**
     * @return BelongsTo<Order, $this>
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    protected static function newFactory(): OrderLineItemFactory
    {
        return OrderLineItemFactory::new();
    }
}
