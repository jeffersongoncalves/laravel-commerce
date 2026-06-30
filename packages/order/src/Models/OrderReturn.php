<?php

namespace JeffersonGoncalves\Commerce\Order\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;

/**
 * @property string $id
 * @property string $order_id
 * @property string $status
 * @property int|null $refund_amount
 * @property string|null $location_id
 * @property array<string, mixed>|null $metadata
 */
class OrderReturn extends BaseModel
{
    protected string $idPrefix = 'return';

    protected $table = 'commerce_returns';

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
     * @return HasMany<ReturnItem, $this>
     */
    public function items(): HasMany
    {
        return $this->hasMany(ReturnItem::class, 'return_id');
    }
}
