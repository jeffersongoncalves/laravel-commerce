<?php

namespace JeffersonGoncalves\Commerce\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Product\Database\Factories\ProductCollectionFactory;

/**
 * @property string $id
 * @property string $title
 * @property string $handle
 * @property array<string, mixed>|null $metadata
 */
class ProductCollection extends BaseModel
{
    /** @use HasFactory<ProductCollectionFactory> */
    use HasFactory;

    protected string $idPrefix = 'pcol';

    protected $table = 'commerce_product_collections';

    protected $guarded = [];

    protected function casts(): array
    {
        return ['metadata' => 'array'];
    }

    /**
     * @return HasMany<Product, $this>
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'collection_id');
    }

    protected static function newFactory(): ProductCollectionFactory
    {
        return ProductCollectionFactory::new();
    }
}
