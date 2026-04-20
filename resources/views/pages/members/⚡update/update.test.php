<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::members.update')
        ->assertStatus(200);
});
