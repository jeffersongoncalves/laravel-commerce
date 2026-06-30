<?php

namespace JeffersonGoncalves\Commerce\Pricing\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Pricing\Database\Factories\PriceRuleFactory;

/**
 * @property string $id
 * @property string $price_id
 * @property string $attribute
 * @property string $operator
 * @property string $value
 * @property int $priority
 * @property array<string, mixed>|null $metadata
 */
class PriceRule extends BaseModel
{
    /** @use HasFactory<PriceRuleFactory> */
    use HasFactory;

    protected string $idPrefix = 'prule';

    protected $table = 'commerce_price_rules';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'priority' => 'integer',
            'metadata' => 'array',
        ];
    }

    /**
     * @return BelongsTo<Price, $this>
     */
    public function price(): BelongsTo
    {
        return $this->belongsTo(Price::class, 'price_id');
    }

    protected static function newFactory(): PriceRuleFactory
    {
        return PriceRuleFactory::new();
    }
}
