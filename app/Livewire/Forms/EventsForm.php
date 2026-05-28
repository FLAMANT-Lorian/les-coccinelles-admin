<?php

namespace App\Livewire\Forms;

use App\Models\Event;
use Livewire\Form;

class EventsForm extends Form
{
    public ?Event $event = null;

    public ?string $name = null;
    public ?string $start_date = null;
    public ?string $end_date = null;
    public ?string $address = null;
    public ?string $description = null;
    public ?string $link = null;

    public function rules(): array
    {
        return [
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'address' => 'required',
            'description' => 'required',
            'link' => 'nullable|url'
        ];
    }

    public function setEvent(Event $event): void
    {
        $this->event = $event;
        $this->name = $event->name;
        $this->start_date = $event->start_date;
        $this->end_date = $event->end_date;
        $this->description = $event->description;
        $this->address = $event->address;
        $this->link = $event->google_drive_url;
    }

    public function update(): void
    {
        $this->event->update([
            'name' => $this->name,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'address' => $this->address,
            'google_drive_url' => $this->link,
        ]);
    }

    public function save(): void
    {
        Event::create([
            'name' => $this->name,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'address' => $this->address,
            'google_drive_url' => $this->link,
        ]);
    }
}
