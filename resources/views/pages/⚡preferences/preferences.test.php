<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::preferences')
        ->assertStatus(200);
});
