<?php

namespace JeffersonGoncalves\Commerce\Product\Services;

use JeffersonGoncalves\Commerce\Core\Services\Service;
use JeffersonGoncalves\Commerce\Product\Models\Product;

class ProductService extends Service
{
    protected function model(): string
    {
        return Product::class;
    }
}
