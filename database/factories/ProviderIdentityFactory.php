<?php

namespace JeffersonGoncalves\Commerce\Auth\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\Auth\Models\AuthIdentity;
use JeffersonGoncalves\Commerce\Auth\Models\ProviderIdentity;

/**
 * @extends Factory<ProviderIdentity>
 */
class ProviderIdentityFactory extends Factory
{
    protected $model = ProviderIdentity::class;

    public function definition(): array
    {
        return [
            'entity_id' => $this->faker->unique()->safeEmail(),
            'provider' => 'emailpass',
            'auth_identity_id' => AuthIdentity::factory(),
            'user_metadata' => null,
        ];
    }
}
