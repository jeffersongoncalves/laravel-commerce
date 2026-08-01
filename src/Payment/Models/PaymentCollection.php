<?php

namespace JeffersonGoncalves\Commerce\Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Payment\Database\Factories\PaymentCollectionFactory;
use JeffersonGoncalves\Commerce\Payment\Enums\PaymentCollectionStatus;

/**
 * @property string $id
 * @property int $amount
 * @property string $currency_code
 * @property PaymentCollectionStatus $status
 * @property int|null $authorized_amount
 * @property int $captured_amount
 * @property int $refunded_amount
 * @property array<string, mixed>|null $metadata
 */
class PaymentCollection extends BaseModel
{
    /** @use HasFactory<PaymentCollectionFactory> */
    use HasFactory;

    protected string $idPrefix = 'paycol';

    protected $table = 'commerce_payment_collections';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'authorized_amount' => 'integer',
            'captured_amount' => 'integer',
            'refunded_amount' => 'integer',
            'status' => PaymentCollectionStatus::class,
            'metadata' => 'array',
        ];
    }

    /**
     * @return HasMany<Payment, $this>
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'payment_collection_id');
    }

    /**
     * @return HasMany<PaymentSession, $this>
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(PaymentSession::class, 'payment_collection_id');
    }

    protected static function newFactory(): PaymentCollectionFactory
    {
        return PaymentCollectionFactory::new();
    }
}
