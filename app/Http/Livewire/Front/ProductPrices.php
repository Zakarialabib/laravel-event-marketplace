<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Store;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ProductPrices extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $listeners = ['updatedSearch' => 'search'];

    public $search = null;

    public $results;
    public $stores;

    public $howMany = 5;

    public function loadMore()
    {
        $this->howMany += 5;
    }

    public function updatedSearch()
    {
        $searchTerm = $this->search;

        if (strlen($this->search) > 3) {
            // Get a list of stores that have products matching the search term
            $this->results = Store::whereHas('products', function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%');
            })
                ->with(['products' => function ($query) {
                    $query->where('name', 'like', '%'.$this->search.'%');
                }])
                ->take($this->howMany)
                ->get();
        } else {
            $this->results = '';
        }
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->results = [];
    }

    public function render(): View|Factory
    {
        return view('livewire.front.product-prices');
    }
}
