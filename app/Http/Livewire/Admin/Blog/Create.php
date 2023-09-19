<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Blog;

use App\Models\Blog;
use App\Models\BlogCategory;
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

    public $createBlog = false;

    public $images;

    public $blog;

    public $description;

    public $listeners = ['createBlog', 'editorjs-save:myEditor' => 'saveEditorState'];

    protected $rules = [
        'blog.title'            => 'required|min:3|max:255',
        'blog.category_id'      => 'required|integer',
        'description'           => 'required|min:3',
        'blog.meta_title'       => 'nullable|max:100',
        'blog.meta_description' => 'nullable|max:200',
    ];

    public function saveEditorState($editorJsonData): void
    {
        $this->description = $editorJsonData;
    }

    public function onImagesUpdated($image): void
    {
        $this->images = $image;
    }

    public function render(): View|Factory
    {
        // abort_if(Gate::denies('blog_create'), 403);

        return view('livewire.admin.blog.create');
    }

    public function createBlog(): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->blog = new Blog();

        $this->createBlog = true;
    }

    public function create(): void
    {
        $this->validate();

        $this->blog->slug = Str::slug($this->blog->title);

        $this->blog->language_id = 1;

        if ($this->images) {
            $this->blog->addMedia($this->images)->toMediaCollection('local_files');
        }

        $this->blog->description = $this->description;

        $this->blog->save();

        $this->emit('refreshIndex');

        $this->alert('success', __('Resource created successfully.'));

        $this->createBlog = false;
    }

    public function getCategoriesProperty()
    {
        return BlogCategory::select('title', 'id')->get();
    }
}
