<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Page;
use App\Models\Section;

class DynamicPage extends Component
{
    public $page;
    public $description;

    public function getSectionsProperty()
    {
        return Section::active()->where('page', $this->page->slug)->get();
    }

    public function mount($slug)
    {
        $this->page = Page::where('slug', $slug)->first() ?? abort(404);
        $this->description = $this->page->description;
    }

    public function render()
    {
        return view('livewire.front.dynamic-page');
    }
}
