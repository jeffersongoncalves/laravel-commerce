<?php

namespace JeffersonGoncalves\Commerce\Loyalty\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Loyalty\Database\Factories\LoyaltyAccountFactory;

/**
 * @property string $id
 * @property string $customer_id
 * @property array<string, mixed>|null $metadata
 */
class LoyaltyAccount extends BaseModel
{
    /** @use HasFactory<LoyaltyAccountFactory> */
    use HasFactory;

    protected string $idPrefix = 'loyacc';

    protected $table = 'commerce_loyalty_accounts';

    protected $guarded = [];

    protected function casts(): array
    {
        return ['metadata' => 'array'];
    }

    /**
     * @return HasMany<LoyaltyTransaction, $this>
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(LoyaltyTransaction::class, 'loyalty_account_id');
    }

    public function balance(): int
    {
        return (int) $this->transactions->sum('points');
    }

    protected static function newFactory(): LoyaltyAccountFactory
    {
        return LoyaltyAccountFactory::new();
    }
}
