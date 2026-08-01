<?php

namespace JeffersonGoncalves\Commerce\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JeffersonGoncalves\Commerce\Auth\Database\Factories\AuthIdentityFactory;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;

/**
 * @property string $id
 * @property array<string, mixed>|null $app_metadata
 */
class AuthIdentity extends BaseModel
{
    /** @use HasFactory<AuthIdentityFactory> */
    use HasFactory;

    protected string $idPrefix = 'authid';

    protected $table = 'commerce_auth_identities';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'app_metadata' => 'array',
        ];
    }

    /**
     * @return HasMany<ProviderIdentity, $this>
     */
    public function providerIdentities(): HasMany
    {
        return $this->hasMany(ProviderIdentity::class);
    }

    protected static function newFactory(): AuthIdentityFactory
    {
        return AuthIdentityFactory::new();
    }
}
