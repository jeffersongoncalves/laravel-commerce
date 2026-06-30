<?php

namespace JeffersonGoncalves\Commerce\Auth\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Auth\Models\AuthIdentity;

/**
 * @extends Factory<AuthIdentity>
 */
class AuthIdentityFactory extends Factory
{
    protected $model = AuthIdentity::class;

    public function definition(): array
    {
        return [
            'app_metadata' => null,
        ];
    }
}
