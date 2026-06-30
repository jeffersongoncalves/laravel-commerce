<?php

namespace JeffersonGoncalves\Commerce\ApiKey\Services;

use JeffersonGoncalves\Commerce\ApiKey\Models\ApiKey;
use JeffersonGoncalves\Commerce\Core\Services\Service;

class ApiKeyService extends Service
{
    protected function model(): string
    {
        return ApiKey::class;
    }

    public function revoke(string $id): ApiKey
    {
        /** @var ApiKey $key */
        $key = $this->retrieve($id);
        $key->update(['revoked_at' => now()]);

        return $key;
    }
}
