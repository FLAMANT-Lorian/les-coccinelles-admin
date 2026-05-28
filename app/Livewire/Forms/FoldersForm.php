<?php

namespace App\Livewire\Forms;

use App\Enums\YesOrNo;
use App\Models\Contact;
use App\Models\Event;
use App\Models\Folder;
use Illuminate\Validation\Rule;
use Livewire\Form;

class FoldersForm extends Form
{
    public ?Folder $folder = null;
    public ?string $name = null;
    public ?string $color = '#000';

    public function rules(): array
    {
        return [
            'name' => 'required',
            'color' => 'required|hex_color'
        ];
    }

    public function setFolder(Folder $folder): void
    {
        //
    }

    public function update(): void
    {
        //
    }

    public function save(Event $event): void
    {
        $event->folders()->create([
            'name' => $this->name,
            'color' => $this->color,
        ]);
    }
}
