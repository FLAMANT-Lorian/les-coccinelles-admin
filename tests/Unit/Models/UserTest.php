<?php

use App\Models\User;
use Spatie\Permission\Models\Role;

it('verifies if you can recover the role using the relation', function () {
    $role = Role::create([
        'name' => 'Président',
        'guard_name' => 'web',
        'unique' => 0
    ]);

    $user = User::factory()->create();

    $user->assignRole($role);

    expect($user->roles()->first()->name)->toBe($role->name)
        ->and($user->roles()->first()->unique)->toBe($role->unique);
});
