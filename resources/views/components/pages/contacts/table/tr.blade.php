@php
    use App\Enums\MessageStatus;
    use App\Enums\YesOrNo;
    use App\Models\Booking;use App\Models\Contact;
    /**
     * @var Contact $contact;
     */
@endphp
@props([
    'contact'
])

<tr x-data="{ open: false }"
    :class="open ? 'lg:[&_div]:bg-beige-medium' : ''">
    <td>
        <div>
            <input type="checkbox"
                   value="{{ $contact->id }}"
                   id="selector-{{ $contact->id }}"
                   wire:model.live="selectedColumn"
                   @change="$refs.table.querySelector(`thead .all-selector`).checked = false;">
            <label for="selector-{{ $contact->id }}"
                   class="sr-only">{{ __('tables.select_item') . $contact->id }}</label>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.full_name') }}&nbsp;:</span>
            @can('update', Contact::class)
                <button type="button"
                        wire:click="$dispatch('open-modal', { modal: 'openUpdateModal', id: {{ $contact->id }}})"
                        class="underline-link after:bg-brown">
                    <span>{{ $contact->full_name }}</span>
                </button>
            @else
                <span>{{ $contact->full_name }}</span>
            @endcan
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.email') }}&nbsp;:</span>
            <a class="underline-link after:bg-brown"
               href="mailto:{{ $contact->email }}"
               aria-label="{{ $contact->email }}"
               title="{{ __('tables.send-email-to') . $contact->email }}"
            >{{ $contact->email }}</a>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.phone') }}&nbsp;:</span>
            <a class="underline-link after:bg-brown"
               href="tel:{{ $contact->telephone }}"
               aria-label="{{ $contact->telephone }}"
               title="{{ __('tables.phone-to') . $contact->telephone }}"
            >{{ $contact->telephone }}</a>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.status') }}&nbsp;:</span>
            <span>{{ $contact->member_card ? __('enums.' . YesOrNo::YES->value) : __('enums.' . YesOrNo::NO->value) }}</span>
        </div>
    </td>
    <td data-action>
        <div class="justify-end lg:relative">
            <button type="button"
                    @click="open = !open"
                    @click.away="open = false"
                    @keydown.window.escape="open = false"
                    :class="open ? 'lg:bg-beige-light' : ''"
                    aria-label="{{ __('tables.fast-actions') }} . ' : ' . {{ $contact->id }}"
                    class="actions">
                <svg width="20" height="4" viewBox="0 0 20 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <use href="#table-actions"></use>
                </svg>
                <span class="sr-only">{{ __('tables.fast-actions') . ' : ' . $contact->id}}</span>
            </button>
            @canany(['update', 'delete'], Contact::class)
                <div x-show="open" x-transition class="actions-table">
                    @can('update', Contact::class)
                        <button type="button"
                                aria-label="{{ __('pages/hall.contacts.update-contact') . ' : ' . $contact->id }}"
                                title="{{ __('pages/hall.contacts.update-contact') . ' : ' . $contact->id }}"
                                wire:click="$dispatch('open-modal', { modal: 'openUpdateModal', id: {{ $contact->id }}  })">
                            <span>{{ __('tables.update') }} <span class="sr-only"> : {{ $contact->id }}</span></span>
                        </button>
                    @endcan
                    @can('delete', Contact::class)
                        <button type="button"
                                aria-label="{{ __('pages/hall.contacts.delete-contact') . ' : ' . $contact->id }}"
                                title="{{ __('pages/hall.contacts.delete-contact') . ' : ' . $contact->id }}"
                                wire:click="$dispatch('open-modal', { modal: 'openDeleteModal', id: {{ $contact->id }}  })">
                            <span>{{ __('tables.delete') }} <span class="sr-only"> : {{ $contact->id }}</span></span>
                        </button>
                    @endcan
                    @can('create', Booking::class)
                        <a class="whitespace-nowrap"
                           title="{{ __('tables.start_booking') . ' : ' . $contact->id }}"
                           aria-label="{{ __('tables.start_booking') . ' : ' . $contact->id }}"
                           href="{{ route('bookings.create', ['contact' => $contact->id]) }}">
                            {{ __('tables.start_booking') }}
                            <span class="sr-only"> : {{ $contact->id }}</span>
                        </a>
                    @endcan
                </div>
            @endcan

            {{-- ACTION MOBILES --}}
            @can('update', Contact::class)
                <div class="actions-mobile">
                    <button type="button"
                            wire:click="$dispatch('open-modal', {modal: 'openUpdateModal', id: {{ $contact->id }}})"
                            class="flex self-start flex-row gap-2 items-center px-4 py-3 border border-brown bg-brown text-white rounded-sm hover:bg-transparent hover:text-brown trans-all"
                            aria-label="{{ __('pages/hall.contacts.update-contact') . ' : ' . $contact->id }}"
                            title="{{ __('pages/hall.contacts.update-contact') . ' : ' . $contact->id }}">
                        <span>{{ __('pages/hall.contacts.update-contact') }} <span class="sr-only"> : {{ $contact->id }}</span></span>
                    </button>
                </div>
            @endcan
        </div>
    </td>
</tr>
