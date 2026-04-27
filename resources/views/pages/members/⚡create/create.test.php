<?php

use App\Enums\MembersStatus;
use App\Enums\Sex;
use Spatie\Permission\Models\Role;
use function Pest\Laravel\assertDatabaseCount;

it('verifies if you can’t create a user without give him a role', function () {
    $role = Role::create([
        'name' => 'Président',
        'guard_name' => 'web',
        'unique' => 0,
    ]);

    Livewire::test('pages.members.members.forms.create.form')
        ->set('form.email', 'test@test.com')
        ->set('form.phone', '0987654321')
        ->set('form.address', 'test')
        ->set('form.postal_code', '4000')
        ->set('form.city', 'Liège')
        ->set('form.status', MembersStatus::active->value)
        ->set('form.sex', Sex::male->value)
        ->set('form.birth_date', '2000-01-01')
        ->set('form.password', 'password')
        ->call('save')
        ->assertHasErrors(['form.role' => 'required']);

    assertDatabaseCount('users', 0);
});
