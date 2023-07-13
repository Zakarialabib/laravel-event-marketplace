<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Blog;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Language;
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

    public $image;

    public $blog;
    
    public $description;

    public $listeners = ['createBlog'];

    protected $rules = [
        'blog.title'       => 'required|min:3|max:255',
        'blog.category_id' => 'required|integer',
        'description'     => 'required|min:3',
        'blog.language_id' => 'nullable|integer',
        'blog.meta_title'  => 'nullable|max:100',
        'blog.meta_description'   => 'nullable|max:200',
    ];

    public function updatedDescription($value)
    {
        $this->description = $value;
    }

    public function render(): View|Factory
    {
        // abort_if(Gate::denies('blog_create'), 403);

        return view('livewire.admin.blog.create');
    }

    public function createBlog()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->blog = new Blog();

        $this->createBlog = true;
    }

    public function create()
    {
        $this->validate();

        $this->blog->slug = Str::slug($this->blog->title);

        if ($this->image) {
            $imageName = Str::slug($this->blog->title).'.'.$this->image->extension();
            $this->image->storeAs('blogs', $imageName);
            $this->blog->image = $imageName;
        }

        $this->blog->description = $this->description;

        $this->blog->save();

        $this->emit('refreshIndex');

        $this->alert('success', __('Blog created successfully.'));

        $this->createBlog = false;
    }

    public function getCategoriesProperty()
    {
        return BlogCategory::select('title', 'id')->get();
    }

    public function getLanguagesProperty()
    {
        return Language::select('name', 'id')->get();
    }
}
