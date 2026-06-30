<?php

namespace JeffersonGoncalves\Commerce\Pricing\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Core\Support\Money;
use JeffersonGoncalves\Commerce\Pricing\Database\Factories\PriceFactory;

/**
 * @property string $id
 * @property string|null $title
 * @property int $amount
 * @property string $currency_code
 * @property string $price_set_id
 * @property string|null $price_list_id
 * @property int|null $min_quantity
 * @property int|null $max_quantity
 * @property array<string, mixed>|null $metadata
 */
class Price extends BaseModel
{
    /** @use HasFactory<PriceFactory> */
    use HasFactory;

    protected string $idPrefix = 'price';

    protected $table = 'commerce_prices';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'min_quantity' => 'integer',
            'max_quantity' => 'integer',
            'metadata' => 'array',
        ];
    }

    public function money(): Money
    {
        return new Money($this->amount, $this->currency_code);
    }

    /**
     * @return BelongsTo<PriceSet, $this>
     */
    public function priceSet(): BelongsTo
    {
        return $this->belongsTo(PriceSet::class, 'price_set_id');
    }

    /**
     * @return BelongsTo<PriceList, $this>
     */
    public function priceList(): BelongsTo
    {
        return $this->belongsTo(PriceList::class, 'price_list_id');
    }

    /**
     * @return HasMany<PriceRule, $this>
     */
    public function rules(): HasMany
    {
        return $this->hasMany(PriceRule::class, 'price_id');
    }

    protected static function newFactory(): PriceFactory
    {
        return PriceFactory::new();
    }
}
