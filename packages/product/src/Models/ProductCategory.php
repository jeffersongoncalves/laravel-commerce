<?php

namespace JeffersonGoncalves\Commerce\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Product\Database\Factories\ProductCategoryFactory;

/**
 * @property string $id
 * @property string $name
 * @property string $handle
 * @property string|null $description
 * @property string|null $parent_category_id
 * @property string|null $mpath
 * @property bool $is_active
 * @property bool $is_internal
 * @property int $rank
 * @property array<string, mixed>|null $metadata
 */
class ProductCategory extends BaseModel
{
    /** @use HasFactory<ProductCategoryFactory> */
    use HasFactory;

    protected string $idPrefix = 'pcat';

    protected $table = 'commerce_product_categories';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_internal' => 'boolean',
            'rank' => 'integer',
            'metadata' => 'array',
        ];
    }

    /**
     * @return BelongsTo<ProductCategory, $this>
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_category_id');
    }

    /**
     * @return HasMany<ProductCategory, $this>
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_category_id');
    }

    /**
     * @return BelongsToMany<Product, $this>
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'commerce_product_category_product',
            'product_category_id',
            'product_id',
        );
    }

    protected static function newFactory(): ProductCategoryFactory
    {
        return ProductCategoryFactory::new();
    }
}
