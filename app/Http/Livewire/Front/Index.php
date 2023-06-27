<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\FeaturedBanner;
use App\Models\Product;
use App\Models\Race;
use App\Models\RaceLocation;
use App\Models\Sponsor;
use App\Models\Section;
use App\Models\Slider;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class Index extends Component
{
    public function getRacesProperty(): Collection
    {
        return Race::active()
            ->orderBy('date', 'desc')
            ->limit(4)
            ->get();
    }

    public function getRaceLocationsProperty(): Collection
    {
        return RaceLocation::active()
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }

    public function getSponsorsProperty(): Collection
    {
        return Sponsor::active()
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }

    public function getPartnersProperty(): Collection
    {
        return Partner::select('name', 'id')->get();
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
        return Slider::active()->take(1)->get();
    }

    public function getFeaturedbannerProperty()
    {
        return FeaturedBanner::where('featured', 1)->first();
    }

    public function getSectionsProperty(): Collection
    {
        return Section::active()->limit(4)->get();
    }

    public function render()
    {
        return view('livewire.front.index')->extends('layouts.app');
    }
}
