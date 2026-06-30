<?php

namespace JeffersonGoncalves\Commerce\Region\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Region\Database\Factories\RegionFactory;

/**
 * @property string $id
 * @property string $name
 * @property string $currency_code
 * @property array<string, mixed>|null $metadata
 */
class Region extends BaseModel
{
    /** @use HasFactory<RegionFactory> */
    use HasFactory;

    protected string $idPrefix = 'reg';

    protected $table = 'commerce_regions';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'metadata' => 'array',
        ];
    }

    /**
     * @return HasMany<Country, $this>
     */
    public function countries(): HasMany
    {
        return $this->hasMany(Country::class);
    }

    protected static function newFactory(): RegionFactory
    {
        return RegionFactory::new();
    }
}
