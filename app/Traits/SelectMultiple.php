<?php

namespace App\Traits;

trait SelectMultiple
{
    public function toggleSelection(string $key, string $value): void
    {
        if (!isset($this->selected[$key])) {
            $this->selected[$key] = [];
        }

        if (in_array($value, $this->selected[$key], true)) {
            $this->selected[$key] = array_filter($this->selected[$key], fn($item) => $item !== $value);
        } else {
            $this->selected[$key][] = $value;
        }
        $this->terms[$key] = '';
    }

    public function changeSelection(string $key, string $value): void
    {
        if (in_array($value, $this->selected[$key], true)) {
            $this->selected[$key] = array_values(
                array_filter($this->selected[$key], fn($item) => $item !== $value)
            );
        } else {
            $this->selected[$key] = [$value];
        }
        $this->terms[$key] = '';
    }
}
