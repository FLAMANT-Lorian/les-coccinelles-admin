<?php


use App\Models\Role;
use App\Models\User;

it('verifies if you can recover the user using the relation', function () {
    $role = Role::factory()->create();

    $user = User::factory()->for($role)->create();

    expect($role->users()->count())->toBe(1)
    ->and($role->users()->first()->first_name)->toBe($user->first_name);
});
