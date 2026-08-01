<?php

namespace JeffersonGoncalves\Commerce\Order\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;

/**
 * @property string $id
 * @property string $claim_id
 * @property string $order_line_item_id
 * @property int $quantity
 * @property string|null $reason
 * @property array<string, mixed>|null $metadata
 */
class ClaimItem extends BaseModel
{
    protected string $idPrefix = 'claimitem';

    protected $table = 'commerce_claim_items';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'metadata' => 'array',
        ];
    }

    /**
     * @return BelongsTo<OrderClaim, $this>
     */
    public function claim(): BelongsTo
    {
        return $this->belongsTo(OrderClaim::class, 'claim_id');
    }
}
