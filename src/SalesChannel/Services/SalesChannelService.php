<?php

namespace JeffersonGoncalves\Commerce\SalesChannel\Services;

use JeffersonGoncalves\Commerce\Core\Services\Service;
use JeffersonGoncalves\Commerce\SalesChannel\Models\SalesChannel;

class SalesChannelService extends Service
{
    protected function model(): string
    {
        return SalesChannel::class;
    }
}
