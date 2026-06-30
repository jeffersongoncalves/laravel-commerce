<?php

namespace JeffersonGoncalves\Commerce\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JeffersonGoncalves\Commerce\Auth\Database\Factories\ProviderIdentityFactory;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;

/**
 * @property string $id
 * @property string $entity_id
 * @property string $provider
 * @property string $auth_identity_id
 * @property array<string, mixed>|null $user_metadata
 */
class ProviderIdentity extends BaseModel
{
    /** @use HasFactory<ProviderIdentityFactory> */
    use HasFactory;

    protected string $idPrefix = 'provid';

    protected $table = 'commerce_provider_identities';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'user_metadata' => 'array',
        ];
    }

    /**
     * @return BelongsTo<AuthIdentity, $this>
     */
    public function authIdentity(): BelongsTo
    {
        return $this->belongsTo(AuthIdentity::class);
    }

    protected static function newFactory(): ProviderIdentityFactory
    {
        return ProviderIdentityFactory::new();
    }
}
