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

    public $subcategory_id;

    public $sorting;

    public $sortingOptions;

    public $selectedCategory;

    public $minPrice = 0;

    public $maxPrice = 0;

    protected $queryString = [
        // 'category_id' => ['except' => '', 'as' => 'c'],
        // 'sorting'     => ['except' => '', 'as' => 'f'],
    ];

    public function getSectionsProperty()
    {
        return Section::active()->where('page', PageType::CATALOG)->get();
    }

    public function filterType($type, $value): void
    {
        if ($type == 'category') {
            $this->category_id = $value;
        } elseif ($type == 'subcategory') {
            $this->subcategory_id = $value;
        }

        $this->resetPage();
    }

    public function clearFilter($type, $value): void
    {
        if ($type == 'category') {
            $this->category_id = null;
        } elseif ($type == 'subcategory') {
            $this->subcategory_id = null;
        }

        $this->resetPage();
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    public function mount(): void
    {
        $this->sortingOptions = [
            'name-asc'   => __('Order Alphabetic, A-Z'),
            'name-desc'  => __('Order Alphabetic, Z-A'),
            'price-asc'  => __('Price, low to high'),
            'price-desc' => __('Price, high to low'),
            'date-asc'   => __('Date, new to old'),
            'date-desc'  => __('Date, old to new'),
        ];
        $this->minPrice = Product::active()->min('price') ?? 0;
        $this->maxPrice = Product::active()->max('price') ?? 0;
    }

    public function applySorting($query)
    {
        return match ($this->sorting) {
            'name'       => $query->orderBy('name', 'asc'),
            'name-desc'  => $query->orderBy('name', 'desc'),
            'price'      => $query->orderBy('price', 'asc'),
            'price-desc' => $query->orderBy('price', 'desc'),
            'date'       => $query->orderBy('created_at', 'asc'),
            'date-desc'  => $query->orderBy('created_at', 'desc'),
            default      => $query,
        };
    }

    public function render()
    {
        $query = Product::active()
            ->when($this->category_id, fn ($q) => $q->where('category_id', $this->category_id))
            ->when($this->subcategory_id, fn ($q) => $q->whereHas('subcategories', fn ($subq) => $subq->whereIn('id', $this->subcategory_id)))
            ->when($this->minPrice, fn ($q) => $q->where('price', '>=', $this->minPrice))
            ->when($this->maxPrice, fn ($q) => $q->where('price', '<=', $this->maxPrice))
            ->when($this->sorting, fn ($q) => $this->applySorting($q));

        $products = $query->paginate($this->perPage);

        return view('livewire.front.catalog', ['products' => $products])->extends('layouts.app');
    }
}
