<?php

namespace JeffersonGoncalves\Commerce\ApiKey\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use JeffersonGoncalves\Commerce\ApiKey\Database\Factories\ApiKeyFactory;
use JeffersonGoncalves\Commerce\ApiKey\Enums\ApiKeyType;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;

/**
 * @property string $id
 * @property string $token
 * @property string $redacted
 * @property string $title
 * @property ApiKeyType $type
 * @property Carbon|null $last_used_at
 * @property Carbon|null $revoked_at
 */
class ApiKey extends BaseModel
{
    /** @use HasFactory<ApiKeyFactory> */
    use HasFactory;

    protected string $idPrefix = 'apk';

    protected $table = 'commerce_api_keys';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'type' => ApiKeyType::class,
            'last_used_at' => 'datetime',
            'revoked_at' => 'datetime',
        ];
    }

    public function isRevoked(): bool
    {
        return $this->revoked_at !== null;
    }

    protected static function newFactory(): ApiKeyFactory
    {
        return ApiKeyFactory::new();
    }
}
