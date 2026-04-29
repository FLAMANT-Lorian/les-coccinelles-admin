@props([
    'role',
])

<div class="mt-8 pt-8 border-t border-t-beige-dark/60">
    <div class="p-6 bg-red-50 border border-red rounded-sm">
        <p class="text-2xl font-medium text-red pb-2">{{ __('pages/roles.delete-role') }}</p>
        <p class="text-base text-brown pb-6">{{ __('pages/roles.delete-role-description') }}</p>
        <button type="button"
                @click="modalOpen = true"
                wire:click="$dispatch('open-modal', { modal: 'deleteRole', id: {{ $role->id }} })"
                class="btn-delete">
            {{ __('pages/roles.delete-role') }}
        </button>
    </div>
</div>
