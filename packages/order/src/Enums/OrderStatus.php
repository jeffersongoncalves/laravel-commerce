<?php

namespace JeffersonGoncalves\Commerce\Order\Enums;

enum OrderStatus: string
{
    case Pending = 'pending';
    case Completed = 'completed';
    case Draft = 'draft';
    case Archived = 'archived';
    case Canceled = 'canceled';
    case RequiresAction = 'requires_action';
}
