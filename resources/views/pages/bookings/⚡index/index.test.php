<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::bookings.index')
        ->assertStatus(200);
});
