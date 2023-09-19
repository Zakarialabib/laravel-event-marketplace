<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Section;

use App\Models\Section;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class Template extends Component
{
    use LivewireAlert;

    use WithFileUploads;

    public $templates = [];

    public $selectedTemplate = [];

    public $createTemplate;

    public $sections = [];

    public $selectTemplate;

    public $listeners = [
        'createTemplate',
    ];

    public function mount(): void
    {
        $this->templates = config('templates');
    }

    public function createTemplate(): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->createTemplate = true;
    }

    public function updatedSelectTemplate(): void
    {
        $this->selectedTemplate = $this->templates[$this->selectTemplate];
    }

    public function create(): void
    {
        try {
            $section = [
                'title'          => $this->selectedTemplate['title'],
                'subtitle'       => $this->selectedTemplate['subtitle'],
                'featured_title' => $this->selectedTemplate['featured_title'],
                'label'          => $this->selectedTemplate['label'],
                'description'    => $this->selectedTemplate['description'],
                'bg_color'       => $this->selectedTemplate['bg_color'],
                'position'       => $this->selectedTemplate['position'],
                'link'           => $this->selectedTemplate['link'],
            ];

            Section::create($section);

            $this->sections[] = $section;

            $this->emit('refreshIndex');

            $this->createTemplate = false;

            $this->alert('success', __('Section created successfully!'));
        } catch (Throwable) {
            $this->alert('warning', __('Section Was not created!'));
        }
    }

    public function render()
    {
        return view('livewire.admin.section.template');
    }
}
