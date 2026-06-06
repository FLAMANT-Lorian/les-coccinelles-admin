@php use App\Enums\MessageStatus;use App\Models\AvailabilityRequest; @endphp
@props([
    'availabilityRequest' => Message::class,
])

<tr x-data="{ open: false }"
    :class="open ? 'lg:[&_div]:bg-beige-medium' : ''">
    <td>
        <div>
            <input type="checkbox"
                   value="{{ $availabilityRequest->id }}"
                   id="selector-{{ $availabilityRequest->id }}"
                   wire:model.live="selectedColumn"
                   @change="$refs.table.querySelector(`thead .all-selector`).checked = false;">
            <label for="selector-{{ $availabilityRequest->id }}" class="sr-only">{{ __('tables.select_item') . $availabilityRequest->id }}</label>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.full_name') }}&nbsp;:</span>
            <button type="button" class="underline-link after:bg-brown"
                    @click="modalOpen = true"
                    wire:click="$dispatch('open-modal', {modal: 'viewAvailabilityRequest', id: {{ $availabilityRequest->id }}}); markAvailabilityRequestAs('{{ MessageStatus::Read->value }}', {{ $availabilityRequest->id }})">
                {{ $availabilityRequest->full_name }}
            </button>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.email') }}&nbsp;:</span>
            <a class="underline-link after:bg-brown"
               href="mailto:{{ $availabilityRequest->email }}"
               aria-label="{{ $availabilityRequest->email }}"
               title="{{ __('tables.send-email-to') . $availabilityRequest->email }}"
            >{{ $availabilityRequest->email }}</a>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.send_date') }}&nbsp;:</span>
            <time datetime="{{ $date = formattedDate($availabilityRequest->created_at) }}">{{ $date }}</time>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.status') }}&nbsp;:</span>
            <x-general.status :status="$availabilityRequest->status"/>
        </div>
    </td>
    <td data-action>
        <div class="justify-end lg:relative">
            <button type="button"
                    @click="open = !open"
                    @click.away="open = false"
                    @keydown.window.escape="open = false"
                    :class="open ? 'lg:bg-beige-light' : ''"
                    title="{{ __('tables.fast-actions') . ' : ' . $availabilityRequest->id }}"
                    class="actions">
                <svg width="20" height="4" viewBox="0 0 20 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <use href="#table-actions"></use>
                </svg>
                <span class="sr-only">{{ __('tables.fast-actions') . ' : ' . $availabilityRequest->id }}</span>
            </button>
            @canany(['delete', 'update'], AvailabilityRequest::class)
                <div x-show="open" x-transition class="actions-table">
                    @can('delete', AvailabilityRequest::class)
                        <button type="button"
                                @click="modalOpen = true"
                                title="{{ __('modals.deleteAvailabilityRequest') . ' : ' . $availabilityRequest->id }}"
                                wire:click="$dispatch('open-modal', {modal: 'deleteAvailabilityRequest', id: {{ $availabilityRequest->id }}})">
                            <span>{{ __('tables.delete') }}</span>
                        </button>
                    @endcan
                    @can('update', AvailabilityRequest::class)
                        @if($availabilityRequest->status === MessageStatus::Unread->value)
                            <button type="button"
                                    title="{{ __('tables.mark-single-as-read') . ' : ' . $availabilityRequest->id }}"
                                    wire:click="markAvailabilityRequestAs('{{ MessageStatus::Read->value }}', {{ $availabilityRequest->id }})">
                                <span>{{ __('tables.mark-single-as-read') }}</span>
                            </button>
                        @endif
                        @if($availabilityRequest->status === MessageStatus::Read->value)
                            <button type="button"
                                    title="{{ __('tables.mark-single-as-not-read') . ' : ' . $availabilityRequest->id }}"
                                    wire:click="markAvailabilityRequestAs('{{ MessageStatus::Unread->value }}', {{ $availabilityRequest->id }})">
                                <span>{{ __('tables.mark-single-as-not-read') }}</span>
                            </button>
                        @endif
                    @endcan
                </div>
            @endcan

            {{-- ACTION MOBILES --}}
            <div class="actions-mobile">
                <a href="mailto:{{ $availabilityRequest->email }}"
                   title="{{ __('modals.reply-to-availability-request') }}"
                   aria-label="{{ __('modals.reply-to-availability-request') }}"
                   class="flex self-start flex-row gap-2 items-center px-4 py-3 border border-brown bg-brown text-white rounded-sm hover:bg-transparent hover:text-brown trans-all">
                    <span class="text-left">{{ __('modals.reply-to-availability-request') }}</span>
                </a>
            </div>
        </div>
    </td>
</tr>
