<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::interventions.index')
        ->assertStatus(200);
});
