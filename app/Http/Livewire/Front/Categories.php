<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Http\Livewire\WithSorting;
use App\Models\RaceLocation;
use App\Models\Category;
use App\Models\Race;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;
    use WithSorting;

    public $listeners = [
        'load-more' => 'loadMore',
    ];

    public $perPage;

    public $paginationOptions;

    public $category_id;

    public $raceLocation_id;

    public $sorting;

    public $status = true;

    public $sortingOptions;

    public $selectedFilters = [];

    protected $queryString = [
        'category_id' => ['except' => '', 'as' => 'c'],
        'sorting'     => ['except' => '', 'as' => 'f'],
    ];

    public function getCategoriesProperty()
    {
        return Category::active()->get();
    }

    public function getRaceLocationsProperty()
    {
        return RaceLocation::active()->get();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function filterType($type, $value)
    {
        switch ($type) {
            case 'category':
                $this->category_id = $value;

                break;
            case 'location':
                $this->raceLocation_id = [$value];

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

    public function loadMore()
    {
        $this->perPage += 25;
    }

    public function mount()
    {
        $this->perPage = 25;
        $this->paginationOptions = [25, 50, 100];
        $this->sortingOptions = [
            'name-asc'   => __('Order Alphabetic, A-Z'),
            'name-desc'  => __('Order Alphabetic, Z-A'),
            'price-asc'  => __('Price, low to high'),
            'price-desc' => __('Price, high to low'),
            'date-asc'   => __('Date, new to old'),
            'date-desc'  => __('Date, old to new'),
            'ThisYear'   => __('This year'),
            'ThisMonth'  => __('This month'),
        ];
    }

    public function render()
    {
        $query = Race::where('category_id', $this->category_id)
            ->when($this->raceLocation_id, function ($query) {
                return $query->where('race_location_id', $this->raceLocation_id);
            })
            ->where('status', $this->status);

        if ($this->sorting === 'name') {
            $races = $query->orderBy('name', 'asc')->paginate($this->perPage);
        } elseif ($this->sorting === 'name-desc') {
            $races = $query->orderBy('name', 'desc')->paginate($this->perPage);
        } elseif ($this->sorting === 'price') {
            $races = $query->orderBy('price', 'asc')->paginate($this->perPage);
        } elseif ($this->sorting === 'price-desc') {
            $races = $query->orderBy('price', 'desc')->paginate($this->perPage);
        } elseif ($this->sorting === 'date') {
            $races = $query->orderBy('created_at', 'asc')->paginate($this->perPage);
        } elseif ($this->sorting === 'date-desc') {
            $races = $query->orderBy('created_at', 'desc')->paginate($this->perPage);
        } elseif ($this->sorting === 'ThisYear') {
            $races = $query->ThisYear()->paginate($this->perPage);
        } elseif ($this->sorting === 'ThisMonth') {
            $races = $query->ThisMonth()->paginate($this->perPage);
        }

        $races = $query->paginate($this->perPage);

        return view('livewire.front.categories', compact('races'))->extends('layouts.app');
    }
}