<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Section;
use App\Enums\PageType;

class BlogShow extends Component
{
    public $blog;

    public function mount($slug)
    {
        $this->blog = Blog::where('slug', $slug)->firstOrFail();
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
        return view('livewire.front.blog-show')->extends('layouts.app');
    }
}
