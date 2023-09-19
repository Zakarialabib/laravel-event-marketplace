<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class SearchBox extends Component
{
    public $listeners = ['updatedSearch' => 'search'];

    public $search;

    public $results = [];

    public $searchBox = true;

    public function updatedSearch(): void
    {
        if (strlen((string) $this->search) > 3) {
            $this->results = Product::active()
                ->where('name', 'like', '%'.$this->search.'%')
                ->orWhere('description', 'like', '%'.$this->search.'%')
                ->limit(5)
                ->get();
        } else {
            $this->results = [];
        }
    }

    public function hideSearchResults(): void
    {
        $this->searchBox = false;
        $this->clearSearch();
    }

    public function clearSearch(): void
    {
        $this->search = '';
        $this->results = [];
    }

    public function render(): View|Factory
    {
        return view('livewire.front.search-box');
    }
}
