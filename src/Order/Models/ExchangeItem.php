<?php

namespace JeffersonGoncalves\Commerce\Order\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;

/**
 * @property string $id
 * @property string $exchange_id
 * @property string $type
 * @property string|null $order_line_item_id
 * @property string|null $variant_id
 * @property int $quantity
 * @property array<string, mixed>|null $metadata
 */
class ExchangeItem extends BaseModel
{
    protected string $idPrefix = 'exchitem';

    protected $table = 'commerce_exchange_items';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'metadata' => 'array',
        ];
    }

    /**
     * @return BelongsTo<OrderExchange, $this>
     */
    public function exchange(): BelongsTo
    {
        return $this->belongsTo(OrderExchange::class, 'exchange_id');
    }
}
