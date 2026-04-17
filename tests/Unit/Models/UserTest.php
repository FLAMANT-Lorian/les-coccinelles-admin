<?php


use App\Models\Role;
use App\Models\User;

it('verifies if you can recover the role using the relation', function () {
    $role = Role::factory()->create();

    $user = User::factory()->for($role)->create();
    expect($user->role->name)->toBe($role->name)
        ->and($user->role->unique)->toBe($role->unique);
});
