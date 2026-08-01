<?php

namespace JeffersonGoncalves\Commerce\StoreCredit\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\StoreCredit\Database\Factories\StoreCreditAccountFactory;

/**
 * @property string $id
 * @property string $customer_id
 * @property string $currency_code
 * @property array<string, mixed>|null $metadata
 */
class StoreCreditAccount extends BaseModel
{
    /** @use HasFactory<StoreCreditAccountFactory> */
    use HasFactory;

    protected string $idPrefix = 'scacc';

    protected $table = 'commerce_store_credit_accounts';

    protected $guarded = [];

    protected function casts(): array
    {
        return ['metadata' => 'array'];
    }

    /**
     * @return HasMany<StoreCreditTransaction, $this>
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(StoreCreditTransaction::class, 'store_credit_account_id');
    }

    public function balance(): int
    {
        return (int) $this->transactions->sum('amount');
    }

    protected static function newFactory(): StoreCreditAccountFactory
    {
        return StoreCreditAccountFactory::new();
    }
}
