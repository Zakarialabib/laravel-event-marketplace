<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Faq;

use App\Http\Livewire\WithSorting;
use App\Models\Faq;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use LivewireAlert;
    
    public $faq;

    public $listeners = [
        'refreshIndex' => '$refresh',
    ];

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

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

    public function getSelectedCountProperty()
    {
        return count($this->selected);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function resetSelected()
    {
        $this->selected = [];
    }

    public function mount()
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->perPage = 100;
        $this->paginationOptions = [25, 50, 100];
        $this->orderable = (new Faq())->orderable;
    }

    public function render(): View|Factory
    {
        $query = Faq::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $faqs = $query->paginate($this->perPage);

        return view('livewire.admin.faq.index', compact('faqs'))->extends('layouts.dashboard');
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('category_delete'), 403);

        Faq::whereIn('id', $this->selected)->delete();

        $this->alert('success', __('Faq deleted successfully.'));

        $this->resetSelected();
    }

    public function delete(Faq $faq)
    {
        abort_if(Gate::denies('faq_delete'), 403);

        $faq->delete();

        $this->alert('success', __('Faq deleted successfully.'));
    }
}
