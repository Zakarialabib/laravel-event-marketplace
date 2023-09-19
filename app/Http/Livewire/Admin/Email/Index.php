<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Email;

use App\Http\Livewire\WithSorting;
use App\Models\EmailTemplate;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithSorting;

    public int $perPage;

    public $email;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    protected $listeners = [
        'refreshIndex' => '$refresh',
    ];

    public array $paginationOptions;

    protected $queryString = [
        'search' => [
            'except' => '',
        ],
        'sortBy' => [
            'except' => 'id',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    public function getSelectedCountProperty(): int
    {
        return count($this->selected);
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    public function resetSelected(): void
    {
        $this->selected = [];
    }

    public function mount(): void
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 100;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new EmailTemplate())->orderable;
    }

    public function render(): View|Factory
    {
        $query = EmailTemplate::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $emails = $query->paginate($this->perPage);

        return view('livewire.admin.email.index', ['emails' => $emails])->extends('layouts.dashboard');
    }

    // Blog Category  Delete
    public function delete(EmailTemplate $email): void
    {
        // abort_if(Gate::denies('email_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $email->delete();
    }
}
