<?php

namespace JeffersonGoncalves\Commerce\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Product\Database\Factories\ProductFactory;
use JeffersonGoncalves\Commerce\Product\Enums\ProductStatus;

/**
 * @property string $id
 * @property string $title
 * @property string|null $subtitle
 * @property string $handle
 * @property string|null $description
 * @property ProductStatus $status
 * @property string|null $thumbnail
 * @property string|null $collection_id
 * @property string|null $type_id
 * @property bool $is_giftcard
 * @property bool $discountable
 * @property array<string, mixed>|null $metadata
 */
class Product extends BaseModel
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory;

    protected string $idPrefix = 'prod';

    protected $table = 'commerce_products';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'status' => ProductStatus::class,
            'weight' => 'float',
            'length' => 'float',
            'height' => 'float',
            'width' => 'float',
            'is_giftcard' => 'boolean',
            'discountable' => 'boolean',
            'metadata' => 'array',
        ];
    }

    /**
     * @return BelongsTo<ProductCollection, $this>
     */
    public function collection(): BelongsTo
    {
        return $this->belongsTo(ProductCollection::class, 'collection_id');
    }

    /**
     * @return BelongsTo<ProductType, $this>
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(ProductType::class, 'type_id');
    }

    /**
     * @return HasMany<ProductVariant, $this>
     */
    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    /**
     * @return HasMany<ProductOption, $this>
     */
    public function options(): HasMany
    {
        return $this->hasMany(ProductOption::class, 'product_id');
    }

    /**
     * @return HasMany<ProductImage, $this>
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    /**
     * @return BelongsToMany<ProductCategory, $this>
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            ProductCategory::class,
            'commerce_product_category_product',
            'product_id',
            'product_category_id',
        );
    }

    /**
     * @return BelongsToMany<ProductTag, $this>
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            ProductTag::class,
            'commerce_product_product_tag',
            'product_id',
            'product_tag_id',
        );
    }

    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }
}
