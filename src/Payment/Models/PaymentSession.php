<?php

namespace JeffersonGoncalves\Commerce\Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Payment\Database\Factories\PaymentSessionFactory;

/**
 * @property string $id
 * @property string $payment_collection_id
 * @property int $amount
 * @property string $currency_code
 * @property string $provider_id
 * @property string $status
 * @property array<string, mixed>|null $data
 * @property array<string, mixed>|null $metadata
 */
class PaymentSession extends BaseModel
{
    /** @use HasFactory<PaymentSessionFactory> */
    use HasFactory;

    protected string $idPrefix = 'payses';

    protected $table = 'commerce_payment_sessions';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'data' => 'array',
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

    protected static function newFactory(): PaymentSessionFactory
    {
        return PaymentSessionFactory::new();
    }
}
