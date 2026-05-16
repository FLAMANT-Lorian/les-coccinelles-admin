<?php

use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {

    #[Computed]
    public function getEvents()
    {

    }
};
?>

<div wire:ignore>
    <div id="coccinelles-calendar"></div>
</div>
