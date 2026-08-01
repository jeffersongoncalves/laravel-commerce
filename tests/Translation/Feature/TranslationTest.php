<?php

use JeffersonGoncalves\Commerce\Translation\Models\Translation;
use JeffersonGoncalves\Commerce\Translation\Services\TranslationService;

it('creates a translation with a prefixed id', function () {
    $translation = Translation::factory()->create();

    expect($translation->id)->toStartWith('trans_');
});

it('upserts and reads a field translation', function () {
    $service = new TranslationService;

    $service->put('product', 'prod_123', 'pt_BR', 'title', 'Camiseta');
    $service->put('product', 'prod_123', 'pt_BR', 'title', 'Camiseta Premium');

    expect($service->get('product', 'prod_123', 'pt_BR', 'title'))->toBe('Camiseta Premium')
        ->and(Translation::query()->count())->toBe(1);
});

it('keeps locales independent', function () {
    $service = new TranslationService;
    $service->put('product', 'prod_9', 'en', 'title', 'Shirt');
    $service->put('product', 'prod_9', 'es', 'title', 'Camisa');

    expect($service->get('product', 'prod_9', 'en', 'title'))->toBe('Shirt')
        ->and($service->get('product', 'prod_9', 'es', 'title'))->toBe('Camisa');
});
