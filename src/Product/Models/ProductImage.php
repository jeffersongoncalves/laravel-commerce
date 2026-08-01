<?php

namespace JeffersonGoncalves\Commerce\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Product\Database\Factories\ProductImageFactory;

/**
 * @property string $id
 * @property string $url
 * @property int $rank
 * @property string $product_id
 * @property array<string, mixed>|null $metadata
 */
class ProductImage extends BaseModel
{
    /** @use HasFactory<ProductImageFactory> */
    use HasFactory;

    protected string $idPrefix = 'pimg';

    protected $table = 'commerce_product_images';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'rank' => 'integer',
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

    protected static function newFactory(): ProductImageFactory
    {
        return ProductImageFactory::new();
    }
}
