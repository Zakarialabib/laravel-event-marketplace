<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\BlogCategory;

use App\Models\BlogCategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $createBlogCategory = false;

    public $listeners = ['createBlogCategory'];

    public $blogcategory;

    protected $rules = [
        'blogcategory.title'            => 'required|string|max:255',
        'blogcategory.description'      => 'nullable',
        'blogcategory.meta_title'       => 'nullable|max:100',
        'blogcategory.meta_description' => 'nullable|max:200',
    ];

    public function render(): View|Factory
    {
        abort_if(Gate::denies('blogcategory_create'), 403);

        return view('livewire.admin.blog-category.create');
    }

    public function createBlogCategory(): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->blogcategory = new BlogCategory();

        $this->createBlogCategory = true;
    }

    public function create(): void
    {
        $this->validate();

        $this->blogcategory->language_id = 1;

        $this->blogcategory->save();

        $this->alert('success', __('BlogCategory created successfully.'));

        $this->createBlogCategory = false;

        $this->emit('refreshIndex');
    }
}
