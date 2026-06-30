<?php

namespace JeffersonGoncalves\Commerce\Customer\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Customer\Database\Factories\CustomerGroupFactory;

/**
 * @property string $id
 * @property string $name
 * @property array<string, mixed>|null $metadata
 */
class CustomerGroup extends BaseModel
{
    /** @use HasFactory<CustomerGroupFactory> */
    use HasFactory;

    protected string $idPrefix = 'cusgroup';

    protected $table = 'commerce_customer_groups';

    protected $guarded = [];

    protected function casts(): array
    {
        return ['metadata' => 'array'];
    }

    /**
     * @return BelongsToMany<Customer, $this>
     */
    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(
            Customer::class,
            'commerce_customer_group_customer',
            'customer_group_id',
            'customer_id',
        );
    }

    protected static function newFactory(): CustomerGroupFactory
    {
        return CustomerGroupFactory::new();
    }
}
