<?php

namespace JeffersonGoncalves\Commerce\Auth\Services;

use JeffersonGoncalves\Commerce\Auth\Models\AuthIdentity;
use JeffersonGoncalves\Commerce\Core\Services\Service;

class AuthIdentityService extends Service
{
    protected function model(): string
    {
        return AuthIdentity::class;
    }
}
