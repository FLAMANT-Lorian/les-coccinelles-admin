<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::settings')
        ->assertStatus(200);
});
