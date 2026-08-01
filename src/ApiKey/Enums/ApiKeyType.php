<?php

namespace JeffersonGoncalves\Commerce\ApiKey\Enums;

enum ApiKeyType: string
{
    case Publishable = 'publishable';
    case Secret = 'secret';
}
