<?php

use App\Models\Intervention;
use App\Models\User;
use Carbon\Carbon;
use function Pest\Laravel\assertDatabaseCount;

it('verifies if you can retrieve interventions created by a user', function () {

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $intervention = Intervention::factory()
        ->createdBy($user1)
        ->assignedTo($user2)
        ->create([
            'name' => 'Intervention 1',
            'description' => 'Description 1',
            'deadline' => Carbon::now()->addDays(10),
        ]);

    expect($user1->createdInterventions()->first()->name)->toBe($intervention->name)
        ->and($user2->assignedInterventions()->first()->name)->toBe($intervention->name)
        ->and($intervention->creator->email)->toBe($user1->email)
        ->and($intervention->assignee->email)->toBe($user2->email);
});

it('verifies if you can create an intervention without creator or without assignee', function () {

    Intervention::factory()->create();

    assertDatabaseCount('interventions', 1);
});
