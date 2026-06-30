<?php

namespace JeffersonGoncalves\Commerce\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Product\Database\Factories\ProductTypeFactory;

/**
 * @property string $id
 * @property string $value
 * @property array<string, mixed>|null $metadata
 */
class ProductType extends BaseModel
{
    /** @use HasFactory<ProductTypeFactory> */
    use HasFactory;

    protected string $idPrefix = 'ptyp';

    protected $table = 'commerce_product_types';

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
        return $this->hasMany(Product::class, 'type_id');
    }

    protected static function newFactory(): ProductTypeFactory
    {
        return ProductTypeFactory::new();
    }
}
