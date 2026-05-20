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

    public ?Meeting $meeting = null;

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
        $this->meeting = $meeting;

        $this->address = $meeting->address;
        $this->date = $meeting->date;
        $this->hour = Carbon::parse($meeting->hour)->format('H:i');
        $this->description = $meeting->description;
    }

    public function update(): void
    {
        $this->meeting->update([
            'address' => $this->address,
            'date' => $this->date,
            'hour' => $this->hour,
            'description' => $this->description
        ]);

        if ($this->file) {
            $disk = config('filesystems.default');
            $original_path = config('meetings.original_path');

            if ($this->meeting->file) {
                $old_path = $original_path . '/' . $this->meeting->file;

                if (Storage::disk($disk)->exists($old_path)) {
                    Storage::disk($disk)->delete($old_path);
                }
            }

            $file_name = 'rapport-reunion-' . $this->meeting->id . '.' . config('meetings.file-type');

            Storage::disk(config('filesystems.default'))
                ->putFileAs(
                    config('meetings.original_path'),
                    $this->file,
                    $file_name
                );

            $this->meeting->update([
                'file' => $file_name,
            ]);
        }
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
