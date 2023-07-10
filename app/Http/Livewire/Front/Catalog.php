<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Http\Livewire\WithSorting;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Section;
use App\Enums\PageType;
class Catalog extends Component
{
    use WithPagination;
    use WithSorting;

    public $perPage = 15;

    public $paginationOptions = [25, 50, 100];

    public $category_id;

    public $sorting;

    public $sortingOptions;

    public $selectedFilters = [];

    protected $queryString = [
        // 'category_id' => ['except' => '', 'as' => 'c'],
        // 'sorting'     => ['except' => '', 'as' => 'f'],
    ];

    public function getSectionsProperty()
    {
        return Section::active()->where('page', PageType::CATALOG)->get();
    }

    public function filterType($type, $value)
    {
        switch ($type) {
            case 'category':
                $this->category_id = $value;

                break;
        }
        $this->resetPage();
    }

    public function clearFilter($filter)
    {
        if ($filter) {
            $this->category_id = null;
            unset($this->selectedFilters['category']);
        }
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->sortingOptions = [
            'name-asc'   => __('Order Alphabetic, A-Z'),
            'name-desc'  => __('Order Alphabetic, Z-A'),
            'price-asc'  => __('Price, low to high'),
            'price-desc' => __('Price, high to low'),
            'date-asc'   => __('Date, new to old'),
            'date-desc'  => __('Date, old to new'),
        ];
    }

    public function render()
    {
        $query = Product::active()
            ->when($this->category_id, function ($query) {
                return $query->where('category_id', '>=', $this->category_id);
            });

        if ($this->sorting === 'name') {
            $products = $query->orderBy('name', 'asc')->paginate($this->perPage);
        } elseif ($this->sorting === 'name-desc') {
            $products = $query->orderBy('name', 'desc')->paginate($this->perPage);
        } elseif ($this->sorting === 'price') {
            $products = $query->orderBy('price', 'asc')->paginate($this->perPage);
        } elseif ($this->sorting === 'price-desc') {
            $products = $query->orderBy('price', 'desc')->paginate($this->perPage);
        } elseif ($this->sorting === 'date') {
            $products = $query->orderBy('created_at', 'asc')->paginate($this->perPage);
        } elseif ($this->sorting === 'date-desc') {
            $products = $query->orderBy('created_at', 'desc')->paginate($this->perPage);
        } else {
            $products = $query->paginate($this->perPage);
        }

        return view('livewire.front.catalog', compact('products'))->extends('layouts.app');
    }
}
