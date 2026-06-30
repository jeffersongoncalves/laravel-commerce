<?php

namespace JeffersonGoncalves\Commerce\Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Payment\Database\Factories\RefundFactory;

/**
 * @property string $id
 * @property string $payment_id
 * @property int $amount
 * @property string|null $reason
 * @property array<string, mixed>|null $metadata
 */
class Refund extends BaseModel
{
    /** @use HasFactory<RefundFactory> */
    use HasFactory;

    protected string $idPrefix = 'ref';

    protected $table = 'commerce_refunds';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'metadata' => 'array',
        ];
    }

    /**
     * @return BelongsTo<Payment, $this>
     */
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    protected static function newFactory(): RefundFactory
    {
        return RefundFactory::new();
    }
}
