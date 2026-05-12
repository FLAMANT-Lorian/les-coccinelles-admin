<?php

use App\Enums\BookingStatus;
use App\Enums\YesOrNo;
use App\Livewire\Forms\BookingsForm;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\HallRate;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {

    public bool $tenantSelectState = false;
    public bool $memberCardSelectState = false;
    public bool $typeSelectState = false;
    public bool $statusSelectState = false;

    public BookingsForm $form;

    public array $terms = [
        'tenant' => '',
        'member_card' => '',
        'type' => '',
        'status' => ''
    ];

    #[Computed]
    public function getContacts()
    {
        $query = Contact::query();

        if (!empty($this->terms['tenant'])) {
            $query->where(function (Builder $q) {
                $q->orwhereRaw('CONCAT(first_name, " ", last_name) LIKE ?', ['%' . $this->terms['tenant'] . '%']);
            });
        }

        $contacts = $query->get();

        return $contacts->isEmpty() ? [] : $contacts;
    }

    #[Computed]
    public function getYesOrNo()
    {
        $cases = YesOrNo::cases();

        if (!empty($this->terms['member_card'])) {
            return array_filter($cases, function ($case) {
                return str_contains(
                    strtolower(__('enums.' . $case->value)),
                    strtolower($this->terms['member_card'])
                );
            });
        }
        return $cases;
    }

    #[Computed]
    public function getTypes()
    {
        $query = HallRate::query();

        $query->where(function (Builder $q) {
            $q->whereLike('type', '%' . $this->terms['type'] . '%');
        });

        $types = $query->get();

        return $types->isEmpty() ? [] : $types;
    }

    #[Computed]
    public function getStatus()
    {
        $cases = BookingStatus::cases();

        if (!empty($this->terms['status'])) {
            return array_filter($cases, function ($case) {
                return str_contains(
                    strtolower(__('enums.' . $case->value)),
                    strtolower($this->terms['status'])
                );
            });
        }
        return $cases;
    }

    public function getDisabledDates(): array
    {
        $disabled_dates = [];
        $bookings = Booking::all();

        foreach ($bookings as $key => $booking) {
            $disabled_dates[$key]['from'] = $booking->start_date->format('Y-m-d');
            $disabled_dates[$key]['to'] = $booking->end_date->format('Y-m-d');
        }

        return $disabled_dates;
    }

    public function save(): void
    {
        $this->form->validate();

        $this->form->save();

        session()->flash('success', __('flash-messages.bookings-created'));

        $this->redirectRoute('bookings.index', navigate: true);
    }
};
?>

<form wire:submit.prevent="save" novalidate>

    <x-pages.bookings.forms.fieldset1/>
    <x-pages.bookings.forms.fieldset2/>
    <x-pages.bookings.forms.fieldset3/>

    {{-- BOUTON --}}
    <x-forms.buttons.submit-filled
        :label="__('pages/hall.bookings-create.create-booking')"
    />
</form>
