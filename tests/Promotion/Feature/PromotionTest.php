<?php

use JeffersonGoncalves\Commerce\Promotion\Enums\ApplicationMethodType;
use JeffersonGoncalves\Commerce\Promotion\Enums\PromotionStatus;
use JeffersonGoncalves\Commerce\Promotion\Models\ApplicationMethod;
use JeffersonGoncalves\Commerce\Promotion\Models\Campaign;
use JeffersonGoncalves\Commerce\Promotion\Models\Promotion;
use JeffersonGoncalves\Commerce\Promotion\Models\PromotionRule;
use JeffersonGoncalves\Commerce\Promotion\Services\PromotionService;

it('creates a promotion with a prefixed id and default status', function () {
    $promotion = (new PromotionService)->create(['code' => 'SAVE10']);

    expect($promotion->id)->toStartWith('promo_')
        ->and($promotion->fresh()->status)->toBe(PromotionStatus::Draft);
});

it('attaches rules and an application method', function () {
    $promotion = Promotion::factory()->create();
    PromotionRule::factory()->count(2)->create(['promotion_id' => $promotion->id]);
    ApplicationMethod::factory()->create([
        'promotion_id' => $promotion->id,
        'type' => ApplicationMethodType::Percentage,
        'value' => 15,
    ]);

    $promotion->load('rules', 'applicationMethod');

    expect($promotion->rules)->toHaveCount(2)
        ->and($promotion->applicationMethod->value)->toBe(15)
        ->and($promotion->applicationMethod->type)->toBe(ApplicationMethodType::Percentage);
});

it('groups promotions under a campaign', function () {
    $campaign = Campaign::factory()->create();
    Promotion::factory()->count(3)->create(['campaign_id' => $campaign->id]);

    expect($campaign->promotions)->toHaveCount(3)
        ->and($campaign->promotions->first()->campaign->id)->toBe($campaign->id);
});
