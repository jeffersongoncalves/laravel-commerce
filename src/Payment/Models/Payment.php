<?php

namespace JeffersonGoncalves\Commerce\Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Payment\Database\Factories\PaymentFactory;

/**
 * @property string $id
 * @property string $payment_collection_id
 * @property int $amount
 * @property string $currency_code
 * @property string $provider_id
 * @property Carbon|null $captured_at
 * @property Carbon|null $canceled_at
 * @property array<string, mixed>|null $metadata
 */
class Payment extends BaseModel
{
    /** @use HasFactory<PaymentFactory> */
    use HasFactory;

    protected string $idPrefix = 'pay';

    protected $table = 'commerce_payments';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'captured_at' => 'datetime',
            'canceled_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    /**
     * @return BelongsTo<PaymentCollection, $this>
     */
    public function collection(): BelongsTo
    {
        return $this->belongsTo(PaymentCollection::class, 'payment_collection_id');
    }

    /**
     * @return HasMany<Capture, $this>
     */
    public function captures(): HasMany
    {
        return $this->hasMany(Capture::class, 'payment_id');
    }

    /**
     * @return HasMany<Refund, $this>
     */
    public function refunds(): HasMany
    {
        return $this->hasMany(Refund::class, 'payment_id');
    }

    public function capturedAmount(): int
    {
        return (int) $this->captures->sum('amount');
    }

    public function refundedAmount(): int
    {
        return (int) $this->refunds->sum('amount');
    }

    protected static function newFactory(): PaymentFactory
    {
        return PaymentFactory::new();
    }
}
