<?php

namespace JeffersonGoncalves\Commerce\Customer\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Customer\Database\Factories\CustomerFactory;

/**
 * @property string $id
 * @property string $email
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $phone
 * @property string|null $company_name
 * @property bool $has_account
 * @property array<string, mixed>|null $metadata
 */
class Customer extends BaseModel
{
    /** @use HasFactory<CustomerFactory> */
    use HasFactory;

    protected string $idPrefix = 'cus';

    protected $table = 'commerce_customers';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'has_account' => 'boolean',
            'metadata' => 'array',
        ];
    }

    /**
     * @return HasMany<CustomerAddress, $this>
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(CustomerAddress::class, 'customer_id');
    }

    /**
     * @return BelongsToMany<CustomerGroup, $this>
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(
            CustomerGroup::class,
            'commerce_customer_group_customer',
            'customer_id',
            'customer_group_id',
        );
    }

    protected static function newFactory(): CustomerFactory
    {
        return CustomerFactory::new();
    }
}
