<?php


use App\Traits\SetActiveTab;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component
{
    use SetActiveTab;

    public function mount(): void
    {
        $allowedTabs = ['roles', 'members'];

        $this->checkAllowedTabs($allowedTabs, 'members');
    }

    public bool $modalDeleteAll = false;


    #[On('open-modal')]
    public function openModal(string $modal): void
    {
        if ($modal === 'deleteAll') {
            $this->modalDeleteAll = true;
        }
    }

    #[On('close-modal')]
    public function closeModal(): void
    {
        $this->modalDeleteAll = false;
    }
};
