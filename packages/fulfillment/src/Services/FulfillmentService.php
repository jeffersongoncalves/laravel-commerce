<?php

namespace JeffersonGoncalves\Commerce\Fulfillment\Services;

use JeffersonGoncalves\Commerce\Core\Services\Service;
use JeffersonGoncalves\Commerce\Fulfillment\Models\Fulfillment;

class FulfillmentService extends Service
{
    protected function model(): string
    {
        return Fulfillment::class;
    }

    public function markShipped(string $fulfillmentId): Fulfillment
    {
        /** @var Fulfillment $fulfillment */
        $fulfillment = $this->retrieve($fulfillmentId);
        $fulfillment->update(['shipped_at' => now()]);

        return $fulfillment;
    }
}
