<?php

namespace JeffersonGoncalves\Commerce\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use JeffersonGoncalves\Commerce\Core\Concerns\HasPrefixedId;

abstract class BaseModel extends Model
{
    use HasPrefixedId;
    use SoftDeletes;
}
