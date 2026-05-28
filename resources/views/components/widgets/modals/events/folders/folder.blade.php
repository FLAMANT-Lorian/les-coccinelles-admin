@props([
    'folder'
])
<x-widgets.modals.modal-layout
    :title="$folder->name">
    <div class="flex flex-col divide-y divide-beige-dark/60">
        <a href="#"
           class="flex flex-row gap-4 p-2 hover:bg-beige-light trans-all">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <use href="#file"></use>
            </svg>
            <span>Nom du fichier</span>
        </a>
    </div>
</x-widgets.modals.modal-layout>
