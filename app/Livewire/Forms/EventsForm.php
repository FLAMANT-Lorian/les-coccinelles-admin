<?php

namespace App\Livewire\Forms;

use App\Models\Event;
use Illuminate\Validation\Rule;
use Livewire\Form;

class EventsForm extends Form
{
    public ?Event $event = null;

    public ?string $name = null;
    public ?string $start_date = null;
    public ?string $end_date = null;
    public ?string $address = null;
    public ?string $description = null;

    public function rules(): array
    {
        return [
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'address' => 'required',
            'description' => 'required',
        ];
    }

    public function setEvent(Event $event): void
    {
        //
    }

    public function update(): void
    {
        //
    }

    public function save(): void
    {
        $uniq_id = slugify($this->start_date . '-' . $this->name);

        Event::create([
            'uniqid' => $uniq_id,
            'name' => $this->name,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'address' => $this->address
        ]);
    }
}
