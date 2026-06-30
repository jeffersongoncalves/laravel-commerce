<?php

namespace JeffersonGoncalves\Commerce\Cart\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JeffersonGoncalves\Commerce\Cart\Database\Factories\CartShippingMethodFactory;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;

/**
 * @property string $id
 * @property string $cart_id
 * @property string $name
 * @property int $amount
 * @property string|null $shipping_option_id
 * @property array<string, mixed>|null $data
 * @property array<string, mixed>|null $metadata
 */
class CartShippingMethod extends BaseModel
{
    /** @use HasFactory<CartShippingMethodFactory> */
    use HasFactory;

    protected string $idPrefix = 'csm';

    protected $table = 'commerce_cart_shipping_methods';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'data' => 'array',
            'metadata' => 'array',
        ];
    }

    /**
     * @return BelongsTo<Cart, $this>
     */
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    protected static function newFactory(): CartShippingMethodFactory
    {
        return CartShippingMethodFactory::new();
    }
}
