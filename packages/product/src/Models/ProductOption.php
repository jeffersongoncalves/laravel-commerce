<?php

namespace JeffersonGoncalves\Commerce\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Product\Database\Factories\ProductOptionFactory;

/**
 * @property string $id
 * @property string $title
 * @property string $product_id
 * @property array<string, mixed>|null $metadata
 */
class ProductOption extends BaseModel
{
    /** @use HasFactory<ProductOptionFactory> */
    use HasFactory;

    protected string $idPrefix = 'popt';

    protected $table = 'commerce_product_options';

    protected $guarded = [];

    protected function casts(): array
    {
        return ['metadata' => 'array'];
    }

    /**
     * @return BelongsTo<Product, $this>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * @return HasMany<ProductOptionValue, $this>
     */
    public function values(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class, 'option_id');
    }

    protected static function newFactory(): ProductOptionFactory
    {
        return ProductOptionFactory::new();
    }
}
