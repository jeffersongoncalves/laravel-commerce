<?php

namespace JeffersonGoncalves\Commerce\Order\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Order\Database\Factories\OrderFactory;
use JeffersonGoncalves\Commerce\Order\Enums\OrderStatus;

/**
 * @property string $id
 * @property int|null $display_id
 * @property string|null $region_id
 * @property string|null $customer_id
 * @property string|null $sales_channel_id
 * @property string|null $email
 * @property string $currency_code
 * @property OrderStatus $status
 * @property array<string, mixed>|null $shipping_address
 * @property array<string, mixed>|null $billing_address
 * @property array<string, mixed>|null $metadata
 */
class Order extends BaseModel
{
    /** @use HasFactory<OrderFactory> */
    use HasFactory;

    protected string $idPrefix = 'order';

    protected $table = 'commerce_orders';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'display_id' => 'integer',
            'status' => OrderStatus::class,
            'shipping_address' => 'array',
            'billing_address' => 'array',
            'canceled_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    /**
     * @return HasMany<OrderLineItem, $this>
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderLineItem::class, 'order_id');
    }

    public function total(): int
    {
        return (int) $this->items->sum(fn (OrderLineItem $item) => $item->subtotal());
    }

    protected static function newFactory(): OrderFactory
    {
        return OrderFactory::new();
    }
}
