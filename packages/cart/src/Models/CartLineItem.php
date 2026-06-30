<?php

namespace JeffersonGoncalves\Commerce\Cart\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JeffersonGoncalves\Commerce\Cart\Database\Factories\CartLineItemFactory;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Product\Models\ProductVariant;

/**
 * @property string $id
 * @property string $cart_id
 * @property string $title
 * @property int $quantity
 * @property int $unit_price
 * @property string|null $product_id
 * @property string|null $variant_id
 * @property array<string, mixed>|null $metadata
 */
class CartLineItem extends BaseModel
{
    /** @use HasFactory<CartLineItemFactory> */
    use HasFactory;

    protected string $idPrefix = 'cli';

    protected $table = 'commerce_cart_line_items';

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
     * @return BelongsTo<Cart, $this>
     */
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    /**
     * @return BelongsTo<ProductVariant, $this>
     */
    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    protected static function newFactory(): CartLineItemFactory
    {
        return CartLineItemFactory::new();
    }
}
