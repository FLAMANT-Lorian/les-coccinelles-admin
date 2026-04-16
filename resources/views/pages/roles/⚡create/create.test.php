<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::roles.create')
        ->assertStatus(200);
});
