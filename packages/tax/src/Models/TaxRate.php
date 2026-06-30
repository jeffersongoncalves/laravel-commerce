<?php

namespace JeffersonGoncalves\Commerce\Tax\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Tax\Database\Factories\TaxRateFactory;

/**
 * @property string $id
 * @property string $tax_region_id
 * @property float|null $rate
 * @property string|null $code
 * @property string $name
 * @property bool $is_default
 * @property bool $is_combinable
 * @property array<string, mixed>|null $metadata
 */
class TaxRate extends BaseModel
{
    /** @use HasFactory<TaxRateFactory> */
    use HasFactory;

    protected string $idPrefix = 'txrate';

    protected $table = 'commerce_tax_rates';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'rate' => 'float',
            'is_default' => 'boolean',
            'is_combinable' => 'boolean',
            'metadata' => 'array',
        ];
    }

    /**
     * @return BelongsTo<TaxRegion, $this>
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(TaxRegion::class, 'tax_region_id');
    }

    protected static function newFactory(): TaxRateFactory
    {
        return TaxRateFactory::new();
    }
}
