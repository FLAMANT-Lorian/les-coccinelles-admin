<?php

use App\Livewire\Forms\TasksForm;
use App\Traits\HandleTasks;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Models\Event;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public TasksForm $tasksForm;

    public Event $event;

    public function mount(Event $event): void
    {
        $this->event = $event->load([
            'tasks',
            'tasks.assignedTo'
        ]);
    }

    public function toggleCompleted(int $id): void
    {
        $task = $this->event->tasks()->findOrFail($id);

        $task->update([
            'completed' => !$task->completed,
        ]);
    }
};
?>

<div class="col-span-full xg:col-start-8 xg:col-span-5">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between items-start gap-6">
        <div>
            <h2 class="text-2xl font-medium text-brown">{{ __('pages/events.tasks.title') }}</h2>
            <p class="text-gray-500 paragraph">{{ __('pages/events.tasks.subtitle', ['count' => $this->event->tasks->where('completed', 0)->count()]) }}</p>
        </div>
        <button type="button"
                wire:click="$dispatch('open-modal', { modal: 'openCreateTaskModal' })"
                class="btn-small bg-brown border border-brown text-white hover:text-brown hover:bg-transparent">
            {{ __('pages/events.tasks.add_tasks') }}
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <use href="#add"></use>
            </svg>
        </button>
    </div>
    <div class="grid grid-cols-1 gap-6 mt-6">
        @if($this->event->tasks->isNotEmpty())
            <div class="flex flex-col divide-y divide-beige-dark/60">
                @foreach($this->event->tasks as $task)
                    <div class="flex flex-row items-center gap-4 py-4 first:pt-0 last:pb-0">
                        <div class="checkbox-field">
                            <input type="checkbox"
                                   id="completed"
                                   {{ $task->completed ? 'checked' : '' }}
                                   wire:change="toggleCompleted({{ $task->id }})">
                            <label for="completed" class="sr-only">
                                {{ __('pages/events.tasks.complete_task') }}
                            </label>
                        </div>
                        <div class="flex flex-col gap-1">
                        <span
                            class="trans-all paragraph text-brown {{ $task->completed ? 'line-through' : '' }}">{{ $task->name }}</span>
                            <span class="text-sm text-gray-500">
                            {{ __('pages/events.tasks.assign_to')}}
                            <strong
                                class="trans-all {{ $task->completed ? 'text-brown' : 'text-red' }} font-medium">{{ $task->assignedTo->full_name }}</strong>
                        </span>
                        </div>
                        <div class="ml-auto flex flex-row gap-3 items-center">
                            <button type="button"
                                    class="hover:bg-beige-medium rounded-sm p-1 trans-all"
                                    wire:click="$dispatch('open-modal', { modal: 'openUpdateTaskModal', task_id: {{ $task->id }} })">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#pen"></use>
                                </svg>
                                <span class="sr-only">{{ __('pages/events.tasks.edit') }}</span>
                            </button>
                            <button type="button"
                                    title="{{ __('pages/events.tasks.delete') }}"
                                    class="hover:bg-beige-medium rounded-sm p-1 trans-all"
                                    wire:click="$dispatch('open-modal', { modal: 'openDeleteTaskModal', task_id: {{ $task->id }} })">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <use href="#bin"></use>
                                </svg>
                                <span class="sr-only">{{ __('pages/events.tasks.delete') }}</span>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="justify-self-end">
                {{ $this->event->tasks()->paginate(config('table.tasks-pagination-numbers'))->links() }}
            </div>
        @endif
    </div>
</div>
