<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Blog;
use App\Models\BlogCategory;
use Livewire\WithPagination;
use App\Models\Section;
use App\Enums\PageType;

class Blogs extends Component
{
    use WithPagination;

    public $category;

    protected $listeners = ['categorySelected'];

    public function categorySelected($category)
    {
        $this->category = $category;
    }

    public function getCategoriesProperty()
    {
        return BlogCategory::select('id', 'title')->get();
    }

    public function getFeaturedBlogsProperty()
    {
        return Blog::active()->where('featured', true)->get();
    }

    public function getSectionsProperty()
    {
        return Section::active()->where('page', PageType::BLOG)->get();
    }

    public function render()
    {
        $blogs = Blog::with('category')
            ->when('category', function ($query) {
                $query->where('category_id', $this->category);
            })->paginate(6);

        return view('livewire.front.blogs', compact('blogs'))->extends('layouts.app');
    }
}
