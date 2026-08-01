<?php

use Illuminate\Database\QueryException;
use JeffersonGoncalves\Commerce\User\Models\User;
use JeffersonGoncalves\Commerce\User\Services\UserService;

it('creates a user with a prefixed id', function () {
    $user = (new UserService)->create([
        'email' => 'admin@example.com',
        'first_name' => 'Ada',
        'last_name' => 'Lovelace',
    ]);

    expect($user->id)->toStartWith('user_')
        ->and($user->fullName())->toBe('Ada Lovelace');
});

it('enforces unique email', function () {
    User::factory()->create(['email' => 'dup@example.com']);
    User::factory()->create(['email' => 'dup@example.com']);
})->throws(QueryException::class);
