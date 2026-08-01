<?php

use JeffersonGoncalves\Commerce\SalesChannel\Models\SalesChannel;
use JeffersonGoncalves\Commerce\SalesChannel\Services\SalesChannelService;

it('creates a sales channel with a prefixed id', function () {
    $channel = (new SalesChannelService)->create(['name' => 'Web']);

    expect($channel->id)->toStartWith('sc_')
        ->and($channel->fresh()->is_disabled)->toBeFalse();
});

it('can be disabled', function () {
    $channel = SalesChannel::factory()->create(['is_disabled' => true]);

    expect($channel->fresh()->is_disabled)->toBeTrue();
});
