<?php

use App\Enums\MessageTypes;
use App\Models\Message;
use App\Models\MessageType;

it('verifies if you can recover the message type using the relation', function () {
    $type = MessageType::factory()
        ->create([
            'name' => MessageTypes::booking->value
        ]);

    $message = Message::factory()
        ->for($type)
        ->create();

    expect($message->messageType->name)->toBe($type->name)
    ->and($type->messages()->first()->email)->toBe($message->email);
});
