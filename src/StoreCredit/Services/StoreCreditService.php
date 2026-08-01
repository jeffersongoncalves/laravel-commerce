<?php

namespace JeffersonGoncalves\Commerce\StoreCredit\Services;

use JeffersonGoncalves\Commerce\Core\Services\Service;
use JeffersonGoncalves\Commerce\StoreCredit\Models\StoreCreditAccount;
use JeffersonGoncalves\Commerce\StoreCredit\Models\StoreCreditTransaction;

class StoreCreditService extends Service
{
    protected function model(): string
    {
        return StoreCreditAccount::class;
    }

    public function credit(string $accountId, int $amount, ?string $reference = null): StoreCreditTransaction
    {
        return $this->record($accountId, abs($amount), $reference);
    }

    public function debit(string $accountId, int $amount, ?string $reference = null): StoreCreditTransaction
    {
        /** @var StoreCreditAccount $account */
        $account = $this->retrieve($accountId);

        if (abs($amount) > $account->balance()) {
            throw new \RuntimeException('Insufficient store credit balance.');
        }

        return $this->record($accountId, -abs($amount), $reference);
    }

    protected function record(string $accountId, int $amount, ?string $reference): StoreCreditTransaction
    {
        /** @var StoreCreditAccount $account */
        $account = $this->retrieve($accountId);

        return $account->transactions()->create([
            'amount' => $amount,
            'reference' => $reference,
        ]);
    }
}
