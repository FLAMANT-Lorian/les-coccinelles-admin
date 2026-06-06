@php use App\Enums\MessageStatus;use App\Models\Role; @endphp
@props([
    'role' => MembersRole::class,
])

@php
    $user = $role->users->first();
@endphp

<tr x-data="{ open: false }"
    :class="open ? 'lg:[&_div]:bg-beige-medium' : ''">
    <td>
        <div>
            <input type="checkbox"
                   value="{{ $role->id }}"
                   id="selector-{{ $role->id }}"
                   wire:model.live="selectedColumn"
                   @change="$refs.table.querySelector(`thead .all-selector`).checked = false;">
            <label for="selector-{{ $role->id }}"
                   class="sr-only">{{ __('tables.select_item') . ' ' . $role->id }}</label>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.role') }}&nbsp;:</span>
            @can('update', Role::class)
                <a class="underline-link after:bg-brown"
                   title="{{ __('general.view-role') . $role->name }}"
                   aria-label="{{ $role->name }}"
                   wire:navigate
                   href="{{ route('roles.edit', ['role' => $role]) }}">
                    {{ $role->name }}
                </a>
            @else
                <span>{{ $role->name }}</span>
            @endcannot
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.unique_role') }}&nbsp;:</span>
            <span>{{ $role->unique ? __('tables.yes') : __('tables.no') }}</span>
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.full_name') }}&nbsp;:</span>
            @can('update', User::class)
                @if($role->unique && $role->users->first())
                    @php
                        $user = $role->users->first();
                    @endphp
                    <a href="{{ route('members.edit', ['member' => $user]) }}"
                       class="underline-link after:bg-brown {{ empty(trim($user->full_name)) ? 'italic text-gray-500' : '' }}"
                       title="{{ __('general.view-profil-of') . $user->full_name }}"
                       wire:navigate
                       aria-label="{{ $user->full_name }}">
                        {{ empty(trim($user->full_name)) ? __('general.not_specified') : $user->full_name }}
                    </a>
                @else
                    <span>–</span>
                @endif
            @else
                @if($role->unique && $role->users->first())
                    @php
                        $user = $role->users->first();
                    @endphp
                    <span>{{ empty(trim($user->full_name)) ? __('general.not_specified') : $user->full_name }}</span>
                @else
                    <span>–</span>
                @endif
            @endcan
        </div>
    </td>
    <td>
        <div>
            <span>{{ __('tables.email') }}&nbsp;:</span>
            @if($role->unique && $role->users->first() && $role->users->first()->email)
                @php
                    $user = $role->users->first();
                @endphp
                <a href="mailto:{{ $role->users->first()->email }}"
                   class="underline-link after:bg-brown"
                   title="{{ __('general.send_email_to') . $role->users->first()->email }}"
                   aria-label="{{ $role->users->first()->email }}">
                    {{ $role->users->first()->email }}
                </a>
            @else
                <span>–</span>
            @endif
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
            @canany(['update', 'delete'], Role::class)
                <div x-show="open" x-transition class="actions-table">
                    @can('update', Role::class)
                        <a href="{{ route('roles.edit', ['role' => $role]) }}"
                           wire:navigate
                           aria-label="{{ __('tables.update') }} : {{ $role->id }}"
                           title="{{ __('modals.edit-role') }}">
                            <span>{{ __('tables.update') }} <span> : {{ $role->id }}</span></span>
                        </a>
                    @endcan
                    @can('delete', Role::class)
                        <button type="button"
                                @click="modalOpen = true"
                                @click.away="open = false"
                                @keydown.window.escape="open = false"
                                aria-label="{{ __('tables.delete') }} : {{ $role->id }}"
                                wire:click="$dispatch('open-modal', {modal: 'deleteRole', id: {{ $role->id }}})">
                            <span>{{ __('tables.delete') }} <span> : {{ $role->id }}</span></span>
                        </button>
                    @endcan
                </div>
            @endcanany

            {{-- ACTION MOBILES --}}
            @can('update', Role::class)
                <div class="actions-mobile">
                    <a href="{{ route('roles.edit', ['role' => $role]) }}"
                       title="{{ __('modals.edit-role') }}"
                       aria-label="{{ __('modals.edit-role') }} : {{ $role->id }}"
                       class="flex self-start flex-row gap-2 items-center px-4 py-3 border border-brown bg-brown text-white rounded-sm hover:bg-transparent hover:text-brown trans-all">
                        <span
                            class="whitespace-nowrap">{{ __('modals.edit-role') }} <span> : {{ $role->id }}</span></span>
                    </a>
                </div>
            @endcan
        </div>
    </td>
</tr>
