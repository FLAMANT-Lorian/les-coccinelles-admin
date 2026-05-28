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
            'color' => 'hex_color'
        ];
    }

    public function setFolder(Folder $folder): void
    {
        $this->folder = $folder;
        $this->name = $folder->name;
        $this->color = $folder->color;
    }

    public function update(): void
    {
        $this->folder->update([
            'name' => $this->name,
            'color' => $this->color,
        ]);
    }

    public function save(Event $event): void
    {
        $event->folders()->create([
            'name' => $this->name,
            'color' => $this->color,
        ]);
    }
}
