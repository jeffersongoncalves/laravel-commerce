<?php

namespace JeffersonGoncalves\Commerce\User\Services;

use JeffersonGoncalves\Commerce\Core\Services\Service;
use JeffersonGoncalves\Commerce\User\Models\User;

class UserService extends Service
{
    protected function model(): string
    {
        return User::class;
    }
}
