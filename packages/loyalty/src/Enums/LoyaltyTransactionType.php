<?php

namespace JeffersonGoncalves\Commerce\Loyalty\Enums;

enum LoyaltyTransactionType: string
{
    case Earn = 'earn';
    case Redeem = 'redeem';
}
