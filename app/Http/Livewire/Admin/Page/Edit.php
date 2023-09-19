<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Page;

use App\Models\Page;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Gate;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $editModal;

    public $page;

    public $image;

    public $description;

    public $listeners = [
        'editModal',
    ];

    public function updatedDescription($value): void
    {
        $this->description = $value;
    }

    protected $rules = [
        'page.title'            => ['required', 'string', 'max:255'],
        'page.slug'             => ['required', 'max:255'],
        'description'           => ['required'],
        'page.meta_title'       => ['nullable', 'max:255'],
        'page.meta_description' => ['nullable', 'max:255'],
        'page.language_id'      => ['nullable', 'integer'],
    ];

    public function render(): View|Factory
    {
        // abort_if(Gate::denies('page_edit'), 403);

        return view('livewire.admin.page.edit');
    }

    public function editModal($page): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->page = Page::findOrFail($page);

        $this->image = $this->page->image ?? '';

        $this->description = $this->page->description;

        $this->editModal = true;
    }

    public function update(): void
    {
        $this->validate();

        if ($this->image instanceof UploadedFile && $this->image->isValid()) {
            $imageName = Str::slug($this->page->name).'-'.date('Y-m-d H:i:s').'.'.$this->image->extension();
            $this->image->storeAs('pages', $imageName);
            $this->page->image = $imageName;
        }

        $this->page->save();

        $this->alert('success', __('Page updated successfully.'));

        $this->emit('refreshIndex');

        $this->editModal = false;
    }
}
