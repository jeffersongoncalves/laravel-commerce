<?php

namespace JeffersonGoncalves\Commerce\Customer\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Customer\Database\Factories\CustomerAddressFactory;

/**
 * @property string $id
 * @property string $customer_id
 * @property string|null $address_1
 * @property string|null $city
 * @property string|null $country_code
 * @property bool $is_default_shipping
 * @property bool $is_default_billing
 * @property array<string, mixed>|null $metadata
 */
class CustomerAddress extends BaseModel
{
    /** @use HasFactory<CustomerAddressFactory> */
    use HasFactory;

    protected string $idPrefix = 'cusaddr';

    protected $table = 'commerce_customer_addresses';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_default_shipping' => 'boolean',
            'is_default_billing' => 'boolean',
            'metadata' => 'array',
        ];
    }

    /**
     * @return BelongsTo<Customer, $this>
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    protected static function newFactory(): CustomerAddressFactory
    {
        return CustomerAddressFactory::new();
    }
}
