<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Page;

use App\Models\Page;
use App\Models\Pagesetting;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $createPage;

    public $page;

    public $image;

    public $description;

    public $listeners = [
        'createPage',
    ];

    public function updatedDescription($value)
    {
        $this->description = $value;
    }

    protected $rules = [
        'page.title'            => ['required', 'string', 'max:255'],
        'page.slug'             => ['required', 'max:255'],
        'description'           => ['required'],
        'page.meta_title'       => ['nullable', 'max:255'],
        'page.meta_description' => ['nullable', 'max:255'],
        'page.language_id'      => ['nullable'],
    ];

    public function render(): View|Factory
    {
        // abort_if(Gate::denies('page_create'), 403);

        return view('livewire.admin.page.create');
    }

    public function createPage()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->page = new Page();

        $this->description = '';

        $this->createPage = true;
    }

    public function create()
    {
        $this->validate();

        $this->page->slug = Str::slug($this->page->name);

        if ($this->description) {
            $imageName = Str::slug($this->page->name).'-'.date('Y-m-d H:i:s').'.'.$this->description->extension();
            $this->description->storeAs('pages', $imageName);
            $this->page->description = $imageName;
        }

        $this->page->save();

        $pageSettings = new Pagesetting([
            'page_id'     => $this->page->id,
            'language_id' => $this->page->language_id,
        ]);

        $this->emit('refreshIndex');

        $this->alert('success', __('Page created successfully!'));

        $this->createPage = false;
    }
}
