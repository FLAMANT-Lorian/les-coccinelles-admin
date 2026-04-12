@php use App\Enums\MessageStatus; @endphp
@props([
    'contactMessage' => Message::class,
])

<tr x-data="{ open: false }"
    :class="open ? '[&_div]:bg-beige-medium' : ''"
    class="[&:has(input:checked)_div]:bg-beige-medium">
    <td>
        <div>
            <input type="checkbox"
                   value="{{ $contactMessage->id }}"
                   id="selector-{{ $contactMessage->id }}"
                   wire:model.live="selectedColumn"
                   @change="$refs.contact_table.querySelector(`thead .all-selector`).checked = false;">
            <label for="$contactMessage->id" class="sr-only">{{ __('tables.select_all') }}</label>
        </div>
    </td>
    <td>
        <div>
            <button type="button" class="underline-link after:bg-brown"
                    wire:click="$dispatch('openModal', {modal: 'viewMessage', id: {{ $contactMessage->id }}})">
                {{ $contactMessage->full_name }}
            </button>
        </div>
    </td>
    <td>
        <div>
            <a class="underline-link after:bg-brown"
                href="mailto:{{ $contactMessage->email }}"
               aria-label="{{ $contactMessage->email }}"
               title="{{ __('tables.send-email-to') . $contactMessage->email }}"
            >{{ $contactMessage->email }}</a>
        </div>
    </td>
    <td>
        <div>
            {{ formattedDate($contactMessage->created_at) }}
        </div>
    </td>
    <td>
        <div>
            <x-general.status :status="$contactMessage->status"/>
        </div>
    </td>
    <td data-action>
        <div class="justify-end relative">
            <span @click="open = !open"
                  @click.away="open = false"
                  @keydown.window.escape="open = false"
                  :class="open ? 'bg-beige-light' : ''"
                  class="p-2 text-brown hover:bg-beige-light trans-all cursor-pointer">
                <svg width="20" height="4" viewBox="0 0 20 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <use href="#table-actions"></use>
                </svg>
            </span>
            <div x-show="open" x-transition class="actions-table">
                <button type="button" class="group" wire:click="deleteMessage({{ $contactMessage->id }})">
                    <span>Supprimer</span>
                </button>
                @if($contactMessage->status === MessageStatus::Unread->value)
                    <button type="button" class="group"
                            wire:click="markMessageAs('{{ MessageStatus::Read->value }}', {{ $contactMessage->id }})">
                        <span>Marquer comme lu</span>
                    </button>
                @endif
                @if($contactMessage->status === MessageStatus::Read->value)
                    <button type="button" class="group"
                            wire:click="markMessageAs('{{ MessageStatus::Unread->value }}', {{ $contactMessage->id }})">
                        <span>Marquer comme non lu</span>
                    </button>
                @endif
            </div>
        </div>
    </td>
</tr>
