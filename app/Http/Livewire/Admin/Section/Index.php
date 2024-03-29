<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Section;

use App\Enums\Status;
use App\Http\Livewire\WithSorting;
use App\Models\Section;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use LivewireAlert;
    use WithSorting;
    use WithFileUploads;

    public $image;

    public $section;

    public $listeners = [
        'refreshIndex' => '$refresh',
        'showModal',  'delete',
    ];

    public $showModal = false;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    public $language_id;

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

    protected $rules = [
        'section.language_id' => 'required',
        'section.page'        => 'required',
        'section.title'       => 'nullable',
        'section.subtitle'    => 'nullable',
        'section.description' => 'nullable',
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
        $this->orderable = (new Section())->orderable;
    }

    public function render(): View|Factory
    {
        $query = Section::when($this->language_id, function ($query) {
            return $query->where('language_id', $this->language_id);
        })->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $sections = $query->paginate($this->perPage);

        return view('livewire.admin.section.index', ['sections' => $sections]);
    }

    // Section  Delete
    public function delete(Section $section): void
    {
        //   abort_if(Gate::denies('section_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $section->delete();

        $this->alert('warning', __('Section Deleted successfully!'));
    }

    // Section  Clone
    public function clone(Section $section): void
    {
        $section_details = Section::find($section->id);

        Section::create([
            'language_id' => $section_details->language_id,
            'page'        => $section_details->page,
            'title'       => $section_details->title,
            'subtitle'    => $section_details->subtitle,
            'link'        => $section_details->link,
            'image'       => $section_details->image,
            'description' => $section_details->description,
            'status'      => Status::INACTIVE,
        ]);
        $this->alert('success', __('Section Cloned successfully!'));
    }

    public function deleteSelected(): void
    {
        // abort_if(Gate::denies('section_delete'), 403);

        Section::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }
}
