<?php

namespace JeffersonGoncalves\Commerce\Promotion\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Promotion\Database\Factories\PromotionRuleFactory;

/**
 * @property string $id
 * @property string $promotion_id
 * @property string $attribute
 * @property string $operator
 * @property string $value
 * @property array<string, mixed>|null $metadata
 */
class PromotionRule extends BaseModel
{
    /** @use HasFactory<PromotionRuleFactory> */
    use HasFactory;

    protected string $idPrefix = 'promorule';

    protected $table = 'commerce_promotion_rules';

    protected $guarded = [];

    protected function casts(): array
    {
        return ['metadata' => 'array'];
    }

    /**
     * @return BelongsTo<Promotion, $this>
     */
    public function promotion(): BelongsTo
    {
        return $this->belongsTo(Promotion::class, 'promotion_id');
    }

    protected static function newFactory(): PromotionRuleFactory
    {
        return PromotionRuleFactory::new();
    }
}
