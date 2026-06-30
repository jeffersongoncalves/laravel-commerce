<?php

namespace JeffersonGoncalves\Commerce\Tax\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Tax\Database\Factories\TaxRegionFactory;

/**
 * @property string $id
 * @property string $country_code
 * @property string|null $province_code
 * @property string|null $parent_id
 * @property array<string, mixed>|null $metadata
 */
class TaxRegion extends BaseModel
{
    /** @use HasFactory<TaxRegionFactory> */
    use HasFactory;

    protected string $idPrefix = 'txreg';

    protected $table = 'commerce_tax_regions';

    protected $guarded = [];

    protected function casts(): array
    {
        return ['metadata' => 'array'];
    }

    /**
     * @return HasMany<TaxRate, $this>
     */
    public function rates(): HasMany
    {
        return $this->hasMany(TaxRate::class, 'tax_region_id');
    }

    protected static function newFactory(): TaxRegionFactory
    {
        return TaxRegionFactory::new();
    }
}
