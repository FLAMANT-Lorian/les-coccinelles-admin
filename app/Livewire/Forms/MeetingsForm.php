<?php

namespace App\Livewire\Forms;

use App\Enums\InterventionStatus;
use App\Models\Intervention;
use App\Models\Meeting;
use App\Models\User;
use App\Traits\CleanLivewireTMPFolder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class MeetingsForm extends Form
{
    use CleanLivewireTMPFolder;

    public ?string $address = null;
    public ?string $date = null;
    public ?string $hour = null;
    public ?string $description = null;
    public ?TemporaryUploadedFile $file = null;

    public function rules(): array
    {
        return [
            'address' => 'required',
            'date' => 'required',
            'hour' => 'required',
            'description' => 'required'
        ];
    }

    public function setMeeting(Meeting $meeting): void
    {
        //
    }

    public function update(): void
    {
        //
    }

    public function save(): void
    {

        $meeting = Meeting::create([
            'address' => $this->address,
            'date' => $this->date,
            'hour' => $this->hour,
            'description' => $this->description
        ]);

        if ($this->file) {
            $file_name = 'rapport-reunion-' . $meeting->id . '.' . config('meetings.file-type');

            Storage::disk(config('filesystems.default'))
                ->putFileAs(
                    config('meetings.original_path'),
                    $this->file,
                    $file_name
                );

            $meeting->update([
                'file' => $file_name,
            ]);
        }

        $this->cleanLivewireTMPFolder();
    }
}
