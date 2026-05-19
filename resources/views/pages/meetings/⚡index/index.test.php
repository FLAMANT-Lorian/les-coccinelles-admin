<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::meetings.index')
        ->assertStatus(200);
});
