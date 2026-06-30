<?php

namespace JeffersonGoncalves\Commerce\Loyalty\Services;

use JeffersonGoncalves\Commerce\Core\Services\Service;
use JeffersonGoncalves\Commerce\Loyalty\Enums\LoyaltyTransactionType;
use JeffersonGoncalves\Commerce\Loyalty\Models\LoyaltyAccount;
use JeffersonGoncalves\Commerce\Loyalty\Models\LoyaltyTransaction;

class LoyaltyService extends Service
{
    protected function model(): string
    {
        return LoyaltyAccount::class;
    }

    public function earn(string $accountId, int $points, ?string $reference = null): LoyaltyTransaction
    {
        return $this->record($accountId, abs($points), LoyaltyTransactionType::Earn, $reference);
    }

    public function redeem(string $accountId, int $points, ?string $reference = null): LoyaltyTransaction
    {
        /** @var LoyaltyAccount $account */
        $account = $this->retrieve($accountId);

        if (abs($points) > $account->balance()) {
            throw new \RuntimeException('Insufficient loyalty point balance.');
        }

        return $this->record($accountId, -abs($points), LoyaltyTransactionType::Redeem, $reference);
    }

    protected function record(string $accountId, int $points, LoyaltyTransactionType $type, ?string $reference): LoyaltyTransaction
    {
        /** @var LoyaltyAccount $account */
        $account = $this->retrieve($accountId);

        return $account->transactions()->create([
            'points' => $points,
            'type' => $type,
            'reference' => $reference,
        ]);
    }
}
