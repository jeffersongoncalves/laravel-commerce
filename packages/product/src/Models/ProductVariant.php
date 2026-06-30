<?php

namespace JeffersonGoncalves\Commerce\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Pricing\Models\PriceSet;
use JeffersonGoncalves\Commerce\Product\Database\Factories\ProductVariantFactory;

/**
 * @property string $id
 * @property string $title
 * @property string|null $sku
 * @property bool $manage_inventory
 * @property bool $allow_backorder
 * @property int $variant_rank
 * @property string $product_id
 * @property string|null $price_set_id
 * @property array<string, mixed>|null $metadata
 */
class ProductVariant extends BaseModel
{
    /** @use HasFactory<ProductVariantFactory> */
    use HasFactory;

    protected string $idPrefix = 'variant';

    protected $table = 'commerce_product_variants';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'manage_inventory' => 'boolean',
            'allow_backorder' => 'boolean',
            'variant_rank' => 'integer',
            'weight' => 'float',
            'metadata' => 'array',
        ];
    }

    /**
     * @return BelongsTo<Product, $this>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * @return BelongsTo<PriceSet, $this>
     */
    public function priceSet(): BelongsTo
    {
        return $this->belongsTo(PriceSet::class, 'price_set_id');
    }

    /**
     * @return BelongsToMany<ProductOptionValue, $this>
     */
    public function optionValues(): BelongsToMany
    {
        return $this->belongsToMany(
            ProductOptionValue::class,
            'commerce_product_variant_option_value',
            'variant_id',
            'option_value_id',
        );
    }

    protected static function newFactory(): ProductVariantFactory
    {
        return ProductVariantFactory::new();
    }
}
