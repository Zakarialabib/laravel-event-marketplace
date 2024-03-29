<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Section;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Collection;
use Throwable;
use App\Models\Section;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Language;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $listeners = [
        'editModal',
    ];

    public $editModal = false;

    public $section;

    public $image;

    public $description;

    protected $rules = [
        'section.language_id' => ['required'],
        'section.page'        => ['nullable'],
        'section.title'       => ['nullable', 'string', 'max:255'],
        'section.subtitle'    => ['nullable', 'string', 'max:255'],
        'section.bg_color'    => ['nullable', 'string', 'max:255'],
        'description'         => ['nullable'],
    ];

    public function updatedDescription($value): void
    {
        $this->description = $value;
    }

    public function editModal($section): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->section = Section::findOrFail($section);

        $this->image = $this->section->image;

        $this->description = $this->section->description;

        $this->editModal = true;
    }

    public function update(): void
    {
        $this->validate();

        // try {

        if ($this->image) {
            $imageName = Str::slug($this->section->title).'.'.$this->image->extension();
            $this->image->storeAs('sections', $imageName);
            $this->section->image = $imageName;
        }

        $this->section->description = $this->description;

        $this->section->save();

        $this->alert('success', __('Section updated successfully!'));

        $this->emit('refreshIndex');

        $this->editModal = false;
        // } catch (Throwable $th) {
        //     $this->alert('warning', __('Section was not updated!'));
        // }
    }

    public function getLanguagesProperty(): Collection
    {
        return Language::select('name', 'id')->get();
    }

    public function render(): View
    {
        return view('livewire.admin.section.edit');
    }
}
