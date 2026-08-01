<?php

namespace JeffersonGoncalves\Commerce\Order\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;

/**
 * @property string $id
 * @property string $order_id
 * @property int $amount
 * @property string $currency_code
 * @property string $type
 * @property string|null $reference
 * @property array<string, mixed>|null $metadata
 */
class OrderTransaction extends BaseModel
{
    protected string $idPrefix = 'ordtx';

    protected $table = 'commerce_order_transactions';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'amount' => 'integer',
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
}
