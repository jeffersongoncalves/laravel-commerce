<?php

namespace JeffersonGoncalves\Commerce\Cart\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use JeffersonGoncalves\Commerce\Cart\Database\Factories\CartFactory;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Customer\Models\Customer;
use JeffersonGoncalves\Commerce\Region\Models\Region;
use JeffersonGoncalves\Commerce\SalesChannel\Models\SalesChannel;

/**
 * @property string $id
 * @property string|null $region_id
 * @property string|null $customer_id
 * @property string|null $sales_channel_id
 * @property string|null $email
 * @property string $currency_code
 * @property array<string, mixed>|null $shipping_address
 * @property array<string, mixed>|null $billing_address
 * @property Carbon|null $completed_at
 * @property array<string, mixed>|null $metadata
 */
class Cart extends BaseModel
{
    /** @use HasFactory<CartFactory> */
    use HasFactory;

    protected string $idPrefix = 'cart';

    protected $table = 'commerce_carts';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'shipping_address' => 'array',
            'billing_address' => 'array',
            'completed_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    /**
     * @return HasMany<CartLineItem, $this>
     */
    public function items(): HasMany
    {
        return $this->hasMany(CartLineItem::class, 'cart_id');
    }

    /**
     * @return HasMany<CartShippingMethod, $this>
     */
    public function shippingMethods(): HasMany
    {
        return $this->hasMany(CartShippingMethod::class, 'cart_id');
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

    public function itemSubtotal(): int
    {
        return (int) $this->items->sum(fn (CartLineItem $item) => $item->subtotal());
    }

    public function shippingTotal(): int
    {
        return (int) $this->shippingMethods->sum('amount');
    }

    public function total(): int
    {
        return $this->itemSubtotal() + $this->shippingTotal();
    }

    protected static function newFactory(): CartFactory
    {
        return CartFactory::new();
    }
}
