<?php

use App\Models\Event;
use App\Models\Folder;
use function Pest\Laravel\assertDatabaseCount;

it('tests relations between events and folders', function () {
    $event = Event::factory()
        ->create();

    $folder = Folder::factory()
        ->for($event)
        ->create();

    assertDatabaseCount('events', 1);
    assertDatabaseCount('folders', 1);

    expect($event->folders()->first()->name)->toBe($folder->name)
        ->and($event->name)->toBe($folder->event->name);
});
