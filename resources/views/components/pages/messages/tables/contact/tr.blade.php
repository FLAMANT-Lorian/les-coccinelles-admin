@php use App\Enums\MessageStatus; @endphp
@props([
    'contactMessage' => Message::class,
])

<tr x-data="{ open: false }"
    :class="open ? 'lg:[&_div]:bg-beige-medium' : ''"
    class="[&:has(input:checked)_div]:bg-beige-medium">
    <td>
        <div>
            <input type="checkbox"
                   value="{{ $contactMessage->id }}"
                   id="selector-{{ $contactMessage->id }}"
                   wire:model.live="selectedColumn"
                   @change="$refs.contact_table.querySelector(`thead .all-selector`).checked = false;">
            <label for="selector-{{ $contactMessage->id }}" class="sr-only">{{ __('tables.select_all') }}</label>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.full_name') }}&nbsp;:</span>
            <button type="button" class="underline-link after:bg-brown"
                    @click="modalOpen = true"
                    wire:click="$dispatch('open-modal', {modal: 'viewMessage', id: {{ $contactMessage->id }}}); markMessageAs('{{ MessageStatus::Read->value }}', {{ $contactMessage->id }})">
                {{ $contactMessage->full_name }}
            </button>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.email') }}&nbsp;:</span>
            <a class="underline-link after:bg-brown"
               href="mailto:{{ $contactMessage->email }}"
               aria-label="{{ $contactMessage->email }}"
               title="{{ __('tables.send-email-to') . $contactMessage->email }}"
            >{{ $contactMessage->email }}</a>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.send_date') }}&nbsp;:</span>
            <time datetime="{{ $date = formattedDate($contactMessage->created_at) }}">{{ $date }}</time>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.status') }}&nbsp;:</span>
            <x-general.status :status="$contactMessage->status"/>
        </div>
    </td>
    <td data-action>
        <div class="justify-end lg:relative">
            <button type="button"
                    @click="open = !open"
                    @click.away="open = false"
                    @keydown.window.escape="open = false"
                    :class="open ? 'lg:bg-beige-light' : ''"
                    class="actions p-2 text-brown hover:bg-beige-light trans-all cursor-pointer">
                <svg width="20" height="4" viewBox="0 0 20 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <use href="#table-actions"></use>
                </svg>
                <span class="sr-only">{{ __('tables.fast-actions') }}</span>
            </button>
            <div x-show="open" x-transition class="actions-table">
                <button type="button" class="group"
                        @click="modalOpen = true"
                        wire:click="$dispatch('open-modal', {modal: 'deleteMessage', id: {{ $contactMessage->id }}})">
                    <span>{{ __('tables.delete') }}</span>
                </button>
                @if($contactMessage->status === MessageStatus::Unread->value)
                    <button type="button" class="group"
                            wire:click="markMessageAs('{{ MessageStatus::Read->value }}', {{ $contactMessage->id }})">
                        <span>{{ __('tables.mark-single-as-read') }}</span>
                    </button>
                @endif
                @if($contactMessage->status === MessageStatus::Read->value)
                    <button type="button" class="group"
                            wire:click="markMessageAs('{{ MessageStatus::Unread->value }}', {{ $contactMessage->id }})">
                        <span>{{ __('tables.mark-single-as-not-read') }}</span>
                    </button>
                @endif
            </div>

            {{-- ACTION MOBILES --}}
            <div class="actions-mobile">
                <button type="button"
                        title="{{ __('modals.see-message') }}"
                        class="flex self-start flex-row gap-2 items-center px-4 py-3 border border-brown bg-brown text-white rounded-sm hover:bg-transparent hover:text-brown trans-all"
                        wire:click="$dispatch('open-modal', {modal: 'viewMessage', id: {{ $contactMessage->id }}})">
                    <span class="whitespace-nowrap">{{ __('modals.reply') }}</span>
                </button>
            </div>
        </div>
    </td>
</tr>
