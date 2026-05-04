@php use App\Enums\MessageStatus; @endphp
@props([
    'member' => User::class,
])

<tr x-data="{ open: false }"
    :class="open ? 'lg:[&_div]:bg-beige-medium' : ''">
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
            @can('members.update')
                <a class="underline-link after:bg-brown {{ empty(trim($member->full_name)) ? 'italic text-gray-500' : '' }}"
                   aria-label="{{ empty(trim($member->full_name)) ? '–' : $member->full_name }}"
                   title="{{ __('pages/members.update-members') }}"
                   href="{{ route('members.update', ['locale' => app()->getLocale(), 'member' => $member->id]) }}"
                   wire:navigate>
                    {{ empty(trim($member->full_name)) ? __('general.not_specified') : $member->full_name }}
                </a>
            @elsecannot('members.update')
                <span>{{ empty(trim($member->full_name)) ? __('general.not_specified') : $member->full_name }}</span>
            @endcannot
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.email') }}&nbsp;:</span>
            <a class="underline-link after:bg-brown"
               aria-label="{{ $member->email }}"
               title="{{ __('general.send_email_to') . $member->email }}"
               href="mailto:{{ $member->email }}">
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
            @can('roles.update')
                <a href="{{ route('roles.update', ['locale' => app()->getLocale(), 'role' => $member->roles->first()->id]) }}"
                   wire:navigate
                   aria-label="{{ $member->roles->first()->name }}"
                   title="{{ __('pages/roles.update-role') }}"
                   class="underline-link after:bg-brown">
                    {{ $member->roles->first()->name }}
                </a>
            @elsecannot('roles.update')
                <span>{{ $member->roles->first()->name }}</span>
            @endcannot
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
            <button type="button"
                    @click="open = !open"
                    @click.away="open = false"
                    @keydown.window.escape="open = false"
                    :class="open ? 'lg:bg-beige-light' : ''"
                    class="actions">
                <svg width="20" height="4" viewBox="0 0 20 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <use href="#table-actions"></use>
                </svg>
                <span class="sr-only">{{ __('tables.fast-actions') }}</span>
            </button>
            @canany(['members.update', 'members.delete'])
                <div x-show="open" x-transition class="actions-table">
                    @can('members.update')
                        <a href="{{ route('members.update', ['locale' => app()->getLocale(), 'member' => $member]) }}"
                           aria-label="{{ __('tables.update') }}"
                           title="{{ __('pages/members.update-members') }}">
                            <span>{{ __('tables.update') }}</span>
                        </a>
                    @endcan
                    @can('members.delete')
                        <button type="button"
                                @click="modalOpen = true"
                                wire:click="$dispatch('open-modal', {modal: 'deleteMember', id: {{ $member->id }}})">
                            <span>{{ __('tables.delete') }}</span>
                        </button>
                    @endcan
                </div>
            @endcanany

            {{--ACTION MOBILES --}}
            @can('members.update')
                <div class="actions-mobile">
                    <a href="{{ route('members.update', ['locale' => app()->getLocale(), 'member' => $member]) }}"
                       title="{{ __('modals.edit-member') }}"
                       aria-label="{{ __('modals.edit') }}"
                       class="flex self-start flex-row gap-2 items-center px-4 py-3 border border-brown bg-brown text-white rounded-sm hover:bg-transparent hover:text-brown trans-all">
                        <span class="whitespace-nowrap">{{ __('modals.edit-member') }}</span>
                    </a>
                </div>
            @endcan
        </div>
    </td>
</tr>
