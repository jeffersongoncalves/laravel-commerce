<?php

use JeffersonGoncalves\Commerce\Fulfillment\Models\Fulfillment;
use JeffersonGoncalves\Commerce\Fulfillment\Models\FulfillmentItem;
use JeffersonGoncalves\Commerce\Fulfillment\Models\FulfillmentSet;
use JeffersonGoncalves\Commerce\Fulfillment\Models\ServiceZone;
use JeffersonGoncalves\Commerce\Fulfillment\Models\ShippingOption;
use JeffersonGoncalves\Commerce\Fulfillment\Services\FulfillmentService;

it('builds a fulfillment set with zones and shipping options', function () {
    $set = FulfillmentSet::factory()->create();
    $zone = ServiceZone::factory()->create(['fulfillment_set_id' => $set->id]);
    ShippingOption::factory()->count(2)->create(['service_zone_id' => $zone->id]);

    expect($set->id)->toStartWith('fuset_')
        ->and($set->serviceZones)->toHaveCount(1)
        ->and($zone->shippingOptions)->toHaveCount(2)
        ->and($zone->shippingOptions->first()->id)->toStartWith('so_');
});

it('relates items to a fulfillment', function () {
    $fulfillment = Fulfillment::factory()->create();
    FulfillmentItem::factory()->count(3)->create(['fulfillment_id' => $fulfillment->id]);

    expect($fulfillment->id)->toStartWith('ful_')
        ->and($fulfillment->items)->toHaveCount(3);
});

it('marks a fulfillment shipped through the service', function () {
    $fulfillment = Fulfillment::factory()->create();

    $shipped = (new FulfillmentService)->markShipped($fulfillment->id);

    expect($shipped->shipped_at)->not->toBeNull();
});
