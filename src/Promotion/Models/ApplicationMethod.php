<?php

namespace JeffersonGoncalves\Commerce\Promotion\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Promotion\Database\Factories\ApplicationMethodFactory;
use JeffersonGoncalves\Commerce\Promotion\Enums\ApplicationMethodType;

/**
 * @property string $id
 * @property string $promotion_id
 * @property ApplicationMethodType $type
 * @property string $target_type
 * @property int $value
 * @property string|null $currency_code
 * @property array<string, mixed>|null $metadata
 */
class ApplicationMethod extends BaseModel
{
    /** @use HasFactory<ApplicationMethodFactory> */
    use HasFactory;

    protected string $idPrefix = 'appmethod';

    protected $table = 'commerce_application_methods';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'type' => ApplicationMethodType::class,
            'value' => 'integer',
            'max_quantity' => 'integer',
            'metadata' => 'array',
        ];
    }

    /**
     * @return BelongsTo<Promotion, $this>
     */
    public function promotion(): BelongsTo
    {
        return $this->belongsTo(Promotion::class, 'promotion_id');
    }

    protected static function newFactory(): ApplicationMethodFactory
    {
        return ApplicationMethodFactory::new();
    }
}
