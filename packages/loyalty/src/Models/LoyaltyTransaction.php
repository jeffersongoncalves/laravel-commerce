<?php

namespace JeffersonGoncalves\Commerce\Loyalty\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Loyalty\Database\Factories\LoyaltyTransactionFactory;
use JeffersonGoncalves\Commerce\Loyalty\Enums\LoyaltyTransactionType;

/**
 * @property string $id
 * @property string $loyalty_account_id
 * @property int $points
 * @property LoyaltyTransactionType $type
 * @property string|null $reference
 * @property array<string, mixed>|null $metadata
 */
class LoyaltyTransaction extends BaseModel
{
    /** @use HasFactory<LoyaltyTransactionFactory> */
    use HasFactory;

    protected string $idPrefix = 'loytx';

    protected $table = 'commerce_loyalty_transactions';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'points' => 'integer',
            'type' => LoyaltyTransactionType::class,
            'metadata' => 'array',
        ];
    }

    /**
     * @return BelongsTo<LoyaltyAccount, $this>
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(LoyaltyAccount::class, 'loyalty_account_id');
    }

    protected static function newFactory(): LoyaltyTransactionFactory
    {
        return LoyaltyTransactionFactory::new();
    }
}
