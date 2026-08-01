<?php

namespace JeffersonGoncalves\Commerce\Payment\Enums;

enum PaymentCollectionStatus: string
{
    case NotPaid = 'not_paid';
    case Awaiting = 'awaiting';
    case Authorized = 'authorized';
    case PartiallyAuthorized = 'partially_authorized';
    case Canceled = 'canceled';
}
