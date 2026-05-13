<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::bookings.update')
        ->assertStatus(200);
});
