<?php

use JeffersonGoncalves\Commerce\Core\Tests\Fixtures\ThingService;

beforeEach(function () {
    $this->service = new ThingService;
});

it('creates and retrieves through the base service', function () {
    $created = $this->service->create(['name' => 'Alpha']);

    expect($this->service->retrieve($created->id)->name)->toBe('Alpha');
});

it('updates and deletes through the base service', function () {
    $thing = $this->service->create(['name' => 'Beta']);

    $this->service->update($thing->id, ['name' => 'Beta2']);
    expect($this->service->retrieve($thing->id)->name)->toBe('Beta2');

    $this->service->delete($thing->id);
    expect($this->service->query()->count())->toBe(0);
});

it('lists with filters', function () {
    $this->service->create(['name' => 'Keep']);
    $this->service->create(['name' => 'Drop']);

    expect($this->service->list(['name' => 'Keep']))->toHaveCount(1);
});
