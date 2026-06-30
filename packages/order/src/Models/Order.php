<?php

namespace JeffersonGoncalves\Commerce\Order\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JeffersonGoncalves\Commerce\Cart\Models\Cart;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Customer\Models\Customer;
use JeffersonGoncalves\Commerce\Order\Database\Factories\OrderFactory;
use JeffersonGoncalves\Commerce\Order\Enums\OrderStatus;
use JeffersonGoncalves\Commerce\Region\Models\Region;
use JeffersonGoncalves\Commerce\SalesChannel\Models\SalesChannel;

/**
 * @property string $id
 * @property string|null $cart_id
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

    /**
     * @return HasMany<OrderTransaction, $this>
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(OrderTransaction::class, 'order_id');
    }

    /**
     * @return HasMany<OrderReturn, $this>
     */
    public function returns(): HasMany
    {
        return $this->hasMany(OrderReturn::class, 'order_id');
    }

    public function capturedTotal(): int
    {
        return (int) $this->transactions->where('type', 'capture')->sum('amount');
    }

    public function refundedTotal(): int
    {
        return (int) $this->transactions->where('type', 'refund')->sum('amount');
    }

    /**
     * @return BelongsTo<Cart, $this>
     */
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    /**
     * @return BelongsTo<Customer, $this>
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * @return BelongsTo<Region, $this>
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    /**
     * @return BelongsTo<SalesChannel, $this>
     */
    public function salesChannel(): BelongsTo
    {
        return $this->belongsTo(SalesChannel::class, 'sales_channel_id');
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
