<?php

declare(strict_types=1);

namespace App\Http\Livewire;

trait WithSorting
{
    public $sortBy = 'id';

    public $sortDirection = 'desc';

    public function sortBy($field): void
    {
        $this->sortBy = $field;

        $this->sortDirection = $this->sortBy === $field
            ? $this->reverseSort()
            : 'asc';
    }

    public function reverseSort(): string
    {
        return $this->sortDirection === 'asc'
            ? 'desc'
            : 'asc';
    }
}
