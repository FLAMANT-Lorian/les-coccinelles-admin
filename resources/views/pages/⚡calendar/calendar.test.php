<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::calendar')
        ->assertStatus(200);
});
