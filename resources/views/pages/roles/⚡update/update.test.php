<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::roles.update')
        ->assertStatus(200);
});
