<?php

namespace JeffersonGoncalves\Commerce\ApiKey\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JeffersonGoncalves\Commerce\ApiKey\Enums\ApiKeyType;
use JeffersonGoncalves\Commerce\ApiKey\Models\ApiKey;

/**
 * @extends Factory<ApiKey>
 */
class ApiKeyFactory extends Factory
{
    protected $model = ApiKey::class;

    public function definition(): array
    {
        $token = 'pk_'.$this->faker->unique()->sha1();

        return [
            'token' => $token,
            'redacted' => substr($token, 0, 6).'...'.substr($token, -3),
            'title' => $this->faker->words(2, true),
            'type' => ApiKeyType::Publishable,
            'last_used_at' => null,
            'revoked_at' => null,
        ];
    }
}
