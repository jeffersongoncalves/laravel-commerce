<?php

namespace JeffersonGoncalves\Commerce\Promotion\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Promotion\Database\Factories\CampaignFactory;

/**
 * @property string $id
 * @property string $name
 * @property string $campaign_identifier
 * @property string|null $description
 * @property int|null $budget_limit
 * @property array<string, mixed>|null $metadata
 */
class Campaign extends BaseModel
{
    /** @use HasFactory<CampaignFactory> */
    use HasFactory;

    protected string $idPrefix = 'camp';

    protected $table = 'commerce_campaigns';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'budget_limit' => 'integer',
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    /**
     * @return HasMany<Promotion, $this>
     */
    public function promotions(): HasMany
    {
        return $this->hasMany(Promotion::class, 'campaign_id');
    }

    protected static function newFactory(): CampaignFactory
    {
        return CampaignFactory::new();
    }
}
