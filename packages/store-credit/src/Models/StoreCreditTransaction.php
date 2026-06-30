<?php

namespace JeffersonGoncalves\Commerce\StoreCredit\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\StoreCredit\Database\Factories\StoreCreditTransactionFactory;

/**
 * @property string $id
 * @property string $store_credit_account_id
 * @property int $amount
 * @property string|null $reference
 * @property array<string, mixed>|null $metadata
 */
class StoreCreditTransaction extends BaseModel
{
    /** @use HasFactory<StoreCreditTransactionFactory> */
    use HasFactory;

    protected string $idPrefix = 'sctx';

    protected $table = 'commerce_store_credit_transactions';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'metadata' => 'array',
        ];
    }

    /**
     * @return BelongsTo<StoreCreditAccount, $this>
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(StoreCreditAccount::class, 'store_credit_account_id');
    }

    protected static function newFactory(): StoreCreditTransactionFactory
    {
        return StoreCreditTransactionFactory::new();
    }
}
