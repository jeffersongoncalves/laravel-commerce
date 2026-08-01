<?php

namespace JeffersonGoncalves\Commerce\Pricing\Enums;

enum PriceListType: string
{
    case Sale = 'sale';
    case Override = 'override';
}
