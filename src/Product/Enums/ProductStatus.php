<?php

namespace JeffersonGoncalves\Commerce\Product\Enums;

enum ProductStatus: string
{
    case Draft = 'draft';
    case Proposed = 'proposed';
    case Published = 'published';
    case Rejected = 'rejected';
}
