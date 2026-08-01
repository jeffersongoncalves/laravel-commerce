<?php

namespace JeffersonGoncalves\Commerce\Order\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;

/**
 * @property string $id
 * @property string $order_id
 * @property string $type
 * @property string $status
 * @property int|null $refund_amount
 * @property array<string, mixed>|null $metadata
 */
class OrderClaim extends BaseModel
{
    protected string $idPrefix = 'claim';

    protected $table = 'commerce_claims';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'refund_amount' => 'integer',
            'metadata' => 'array',
        ];
    }

    /**
     * @return BelongsTo<Order, $this>
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * @return HasMany<ClaimItem, $this>
     */
    public function items(): HasMany
    {
        return $this->hasMany(ClaimItem::class, 'claim_id');
    }
}
