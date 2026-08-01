<?php

namespace JeffersonGoncalves\Commerce\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Product\Database\Factories\ProductTagFactory;

/**
 * @property string $id
 * @property string $value
 * @property array<string, mixed>|null $metadata
 */
class ProductTag extends BaseModel
{
    /** @use HasFactory<ProductTagFactory> */
    use HasFactory;

    protected string $idPrefix = 'ptag';

    protected $table = 'commerce_product_tags';

    protected $guarded = [];

    protected function casts(): array
    {
        return ['metadata' => 'array'];
    }

    /**
     * @return BelongsToMany<Product, $this>
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'commerce_product_product_tag',
            'product_tag_id',
            'product_id',
        );
    }

    protected static function newFactory(): ProductTagFactory
    {
        return ProductTagFactory::new();
    }
}
