<?php

namespace JeffersonGoncalves\Commerce\Promotion\Enums;

enum PromotionStatus: string
{
    case Draft = 'draft';
    case Active = 'active';
    case Inactive = 'inactive';
}
