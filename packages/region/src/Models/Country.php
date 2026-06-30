<?php

namespace JeffersonGoncalves\Commerce\Region\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JeffersonGoncalves\Commerce\Region\Database\Factories\CountryFactory;

/**
 * @property string $iso_2
 * @property string $iso_3
 * @property string $num_code
 * @property string $name
 * @property string $display_name
 * @property string|null $region_id
 */
class Country extends Model
{
    /** @use HasFactory<CountryFactory> */
    use HasFactory;

    protected $table = 'commerce_countries';

    protected $primaryKey = 'iso_2';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];

    /**
     * @return BelongsTo<Region, $this>
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    protected static function newFactory(): CountryFactory
    {
        return CountryFactory::new();
    }
}
