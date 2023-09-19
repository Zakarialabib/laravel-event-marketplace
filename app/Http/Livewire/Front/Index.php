<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\FeaturedBanner;
use App\Models\Product;
use App\Models\Partner;
use App\Models\Race;
use App\Models\Section;
use App\Models\Slider;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Enums\PageType;
use App\Models\Category;

class Index extends Component
{
    public $category_name;

    public function getRacesProperty(): Collection
    {
        return Race::active()
            ->when($this->category_name, function ($query): void {
                $query->where('category_id', Category::where('name', $this->category_name)->first()->id);
            })
            ->orderBy('start_registration', 'desc')
            ->limit(4)
            ->get();
    }

    public function filterType($value): void
    {
        $this->category_name = $value;
    }

    public function getPartnersProperty(): Collection
    {
        return Partner::active()->select('name', 'id')->get();
    }

    public function getFeaturedProductsProperty(): Collection
    {
        return Product::active()
            // ->where('featured', true)
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }

    public function getSlidersProperty(): Collection
    {
        return Slider::active()->take(5)->get();
    }

    public function getFeaturedbannerProperty()
    {
        return FeaturedBanner::where('featured', 1)->first();
    }

    public function getSectionsProperty(): Collection
    {
        return Section::active()
            ->where('page', PageType::HOME)
            ->limit(4)
            ->get();
    }

    public function render()
    {
        return view('livewire.front.index')->extends('layouts.app');
    }
}
