<?php

namespace App\Traits;

use Livewire\Attributes\On;
use Livewire\Attributes\Url;

trait TableFilter
{
    #[Url]
    public string $term = '';

    public string $filter_term = '';

    public array $filter = [];

    #[Url]
    public ?string $filter_column = null;
    #[Url]
    public ?string $filter_direction = null;

    public function sortBy(string $column, string $direction): void
    {
        if ($direction === 'middle') {
            $this->filter_direction = null;
            $this->filter_column = null;
            return;
        }

        $this->filter_column = $column;
        $this->filter_direction = $direction;
    }

    #[On('reset-filter')]
    public function resetFilter(): void
    {
        $this->term = '';
        $this->filter_term = '';
        $this->filter = [];
    }
}
