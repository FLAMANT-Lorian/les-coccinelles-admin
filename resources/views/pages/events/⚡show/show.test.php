<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::events.show')
        ->assertStatus(200);
});
