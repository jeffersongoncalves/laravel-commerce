<?php

namespace JeffersonGoncalves\Commerce\Promotion\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Promotion\Database\Factories\PromotionFactory;
use JeffersonGoncalves\Commerce\Promotion\Enums\PromotionStatus;
use JeffersonGoncalves\Commerce\Promotion\Enums\PromotionType;

/**
 * @property string $id
 * @property string $code
 * @property bool $is_automatic
 * @property PromotionType $type
 * @property PromotionStatus $status
 * @property string|null $campaign_id
 * @property array<string, mixed>|null $metadata
 */
class Promotion extends BaseModel
{
    /** @use HasFactory<PromotionFactory> */
    use HasFactory;

    protected string $idPrefix = 'promo';

    protected $table = 'commerce_promotions';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_automatic' => 'boolean',
            'type' => PromotionType::class,
            'status' => PromotionStatus::class,
            'metadata' => 'array',
        ];
    }

    /**
     * @return BelongsTo<Campaign, $this>
     */
    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }

    /**
     * @return HasMany<PromotionRule, $this>
     */
    public function rules(): HasMany
    {
        return $this->hasMany(PromotionRule::class, 'promotion_id');
    }

    /**
     * @return HasOne<ApplicationMethod, $this>
     */
    public function applicationMethod(): HasOne
    {
        return $this->hasOne(ApplicationMethod::class, 'promotion_id');
    }

    protected static function newFactory(): PromotionFactory
    {
        return PromotionFactory::new();
    }
}
