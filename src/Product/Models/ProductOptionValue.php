<?php

namespace JeffersonGoncalves\Commerce\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Product\Database\Factories\ProductOptionValueFactory;

/**
 * @property string $id
 * @property string $value
 * @property string $option_id
 * @property array<string, mixed>|null $metadata
 */
class ProductOptionValue extends BaseModel
{
    /** @use HasFactory<ProductOptionValueFactory> */
    use HasFactory;

    protected string $idPrefix = 'poval';

    protected $table = 'commerce_product_option_values';

    protected $guarded = [];

    protected function casts(): array
    {
        return ['metadata' => 'array'];
    }

    /**
     * @return BelongsTo<ProductOption, $this>
     */
    public function option(): BelongsTo
    {
        return $this->belongsTo(ProductOption::class, 'option_id');
    }

    /**
     * @return BelongsToMany<ProductVariant, $this>
     */
    public function variants(): BelongsToMany
    {
        return $this->belongsToMany(
            ProductVariant::class,
            'commerce_product_variant_option_value',
            'option_value_id',
            'variant_id',
        );
    }

    protected static function newFactory(): ProductOptionValueFactory
    {
        return ProductOptionValueFactory::new();
    }
}
