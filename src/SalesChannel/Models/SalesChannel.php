<?php

namespace JeffersonGoncalves\Commerce\SalesChannel\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\SalesChannel\Database\Factories\SalesChannelFactory;

/**
 * @property string $id
 * @property string $name
 * @property string|null $description
 * @property bool $is_disabled
 * @property array<string, mixed>|null $metadata
 */
class SalesChannel extends BaseModel
{
    /** @use HasFactory<SalesChannelFactory> */
    use HasFactory;

    protected string $idPrefix = 'sc';

    protected $table = 'commerce_sales_channels';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_disabled' => 'boolean',
            'metadata' => 'array',
        ];
    }

    protected static function newFactory(): SalesChannelFactory
    {
        return SalesChannelFactory::new();
    }
}
