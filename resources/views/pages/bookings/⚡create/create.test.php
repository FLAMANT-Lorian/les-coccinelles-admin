<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::bookings.create')
        ->assertStatus(200);
});
