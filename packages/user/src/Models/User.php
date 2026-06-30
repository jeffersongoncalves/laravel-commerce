<?php

namespace JeffersonGoncalves\Commerce\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\User\Database\Factories\UserFactory;

/**
 * @property string $id
 * @property string $email
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $avatar_url
 * @property array<string, mixed>|null $metadata
 */
class User extends BaseModel
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    protected string $idPrefix = 'user';

    protected $table = 'commerce_users';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'metadata' => 'array',
        ];
    }

    public function fullName(): string
    {
        return trim(($this->first_name ?? '').' '.($this->last_name ?? ''));
    }

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
