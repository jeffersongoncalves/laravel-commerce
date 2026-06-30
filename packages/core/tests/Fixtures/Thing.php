<?php

namespace JeffersonGoncalves\Commerce\Core\Tests\Fixtures;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use JeffersonGoncalves\Commerce\Core\Casts\MoneyCast;
use JeffersonGoncalves\Commerce\Core\Models\BaseModel;
use JeffersonGoncalves\Commerce\Core\Support\Money;

/**
 * @property string $id
 * @property string $name
 * @property Money|null $price
 */
class Thing extends BaseModel
{
    use HasFactory;

    protected string $idPrefix = 'thing';

    protected $table = 'commerce_things';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'price' => MoneyCast::class,
        ];
    }
}
