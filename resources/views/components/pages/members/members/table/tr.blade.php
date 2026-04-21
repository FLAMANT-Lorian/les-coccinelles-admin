@php use App\Enums\MessageStatus; @endphp
@props([
    'member' => User::class,
])

<tr x-data="{ open: false }"
    :class="open ? 'lg:[&_div]:bg-beige-medium' : ''"
    class="[&:has(input:checked)_div]:bg-beige-medium">
    <td>
        <div>
            <input type="checkbox"
                   value="{{ $member->id }}"
                   id="selector-{{ $member->id }}"
                   wire:model.live="selectedColumn"
                   @change="$refs.table.querySelector(`thead .all-selector`).checked = false;">
            <label for="selector-{{ $member->id }}" class="sr-only">{{ __('tables.select_all') }}</label>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.full_name') }}&nbsp;:</span>
                <a class="underline-link after:bg-brown"
                   aria-label="{{ trim($member->full_name) === '' ? '–' : $member->full_name }}"
                   title="{{ __('pages/members.update-members') }}"
                   href="{{ route('members.update', ['locale' => app()->getLocale(), 'member' => $member->id]) }}">
                    {{ trim($member->full_name) === '' ? '–' : $member->full_name }}
                </a>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.email') }}&nbsp;:</span>
            <a class="underline-link after:bg-brown"
               aria-label="{{ $member->email }}"
               title="{{ __('pages/members.update-members') }}"
               href="{{ route('members.update', ['locale' => app()->getLocale(), 'member' => $member->id]) }}">
                {{ $member->email }}
            </a>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.phone') }}&nbsp;:</span>
            <span>{{ $member->phone }}</span>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.role') }}&nbsp;:</span>
            <span>{{ $member->roles->first()->name }}</span>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.status') }}&nbsp;:</span>
            <x-general.status :status="$member->status"/>
        </div>
    </td>
    <td data-action>
        <div class="justify-end lg:relative">
            <span>TODO</span>
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
                <button type="button" class="group cursor-not-allowed" disabled>
                    <span>Modifier</span>
                </button>
                <button type="button" class="group cursor-not-allowed" disabled>
                    <span>Supprimer</span>
                </button>
            </div>

            {{--ACTION MOBILES --}}
            {{--<div class="actions-mobile">
                <button type="button"
                        title="{{ __('modals.see-message') }}"
                        class="flex self-start flex-row gap-2 items-center px-4 py-3 border border-brown bg-brown text-white rounded-sm hover:bg-transparent hover:text-brown trans-all"
                        wire:click="$dispatch('open-modal', {modal: 'viewMessage', id: {{ $contactMessage->id }}})">
                    <span class="whitespace-nowrap">{{ __('modals.reply') }}</span>
                </button>
            </div>--}}
        </div>
    </td>
</tr>
