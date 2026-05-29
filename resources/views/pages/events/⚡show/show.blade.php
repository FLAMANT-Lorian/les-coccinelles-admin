@php
    use App\Enums\MessageTypes;
    use App\Models\Event;

    $segments = [
        [
            'label' => __('navigation/navigation.events'),
            'url' => route('events.index')
        ],
        [
            'label' => $event->name
        ]
    ];
@endphp

<div class="wrapper">
    {{-- BREADCRUMB --}}
    <x-general.breadcrumb
        :segments="$segments"/>

    <div class="content grid-default gap-y-8">
        {{-- HEADING --}}
        <x-pages.events.show.base.heading
            :event="$event"/>

        <div class="grid-default gap-y-8 col-span-full">
            {{-- FOLDERS --}}
            <livewire:pages.events.show.folders.folders
                :event="$event"/>

            <span aria-hidden="true"
                  class="max-xg:hidden col-span-1 justify-self-center h-full w-px bg-beige-dark/60"></span>

            {{-- TASKS --}}
            <livewire:pages.events.show.tasks.tasks
                :event="$event"/>
        </div>

        {{-- DANGER ZONE --}}
        @can('delete', Event::class)
            <x-pages.events.show.base.danger-zone/>
        @endcan
    </div>

    {{-- MODALS --}}
    @if($this->openEditModal)
        <x-widgets.modals.events.update-event/>
    @elseif($this->openDeleteModal)
        <x-widgets.modals.events.delete-event
            :id="$event->id"/>
    @elseif($this->openCreateFolderModal)
        <x-widgets.modals.events.folders.create-folder/>
    @elseif($this->openUpdateFolderModal)
        <x-widgets.modals.events.folders.update-folder/>
    @elseif($this->openDeleteFolderModal)
        <x-widgets.modals.events.folders.delete-folder
            :id="$folder->id"/>
    @elseif($this->openFolderModal)
        <x-widgets.modals.events.folders.folder
            :folder="$folder"/>
    @elseif($this->openCreateTaskModal)
        <x-widgets.modals.events.tasks.create-task/>
    @elseif($this->openUpdateTaskModal)
        <x-widgets.modals.events.tasks.update-task/>
    @elseif($this->openDeleteTaskModal)
        <x-widgets.modals.events.tasks.delete-task
            :id="$task->id"/>
    @endif
</div>
