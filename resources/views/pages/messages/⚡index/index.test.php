<?php

use App\Enums\MessageTypes;
use App\Models\Message;
use App\Models\MessageType;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

/*it('can view delete a message using the fast actions in the table', function () {
    $messageType = MessageType::factory()->create(['name' => MessageTypes::contact->value]);

    $message = Message::factory()->for($messageType)->create();

    $page = visit(route('messages', ['locale' => config('app.locale')]));

    $page->assertSee($message->full_name)
        ->click('[data-action] .actions')
        ->assertSee('Supprimer')
        ->click('Supprimer')
        ->assertDontSee($message->full_name);

    $this->assertDatabaseMissing('messages', [
        'first_name' => $message->first_name,
        'last_name' => $message->last_name,
    ]);
});*/
