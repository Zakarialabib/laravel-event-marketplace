<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Race;

use App\Models\Category;
use App\Models\Race;
use App\Models\RaceLocation;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $listeners = [
        'imagesUpdated' => 'onImagesUpdated',
    ];

    public $race;

    public $images;

    public $options = [];

    public $social_media = [];

    public $sponsors = [];

    public $courses = [];

    public $features = [];

    public $calendar = [];

    public $description = '';

    public array $listsForFields = [];

    public array $rules = [

        'race.name'                  => ['required', 'string', 'max:255'],
        'race.date'                  => ['required', 'date'],
        'race.price'                 => ['required', 'numeric', 'max:2147483647'],
        'race.race_location_id'      => ['required', 'integer'],
        'race.category_id'           => ['required', 'integer'],
        'race.elevation_gain'        => ['nullable', 'string'],
        'race.number_of_days'        => ['required', 'numeric', 'max:2147483647'],
        'race.start_registration'    => ['required', 'date'],
        'race.end_registration'      => ['required', 'date'],
        'race.registration_deadline' => ['required', 'date'],
        'race.number_of_racers'      => ['required', 'numeric', 'max:2147483647'],
        'race.first_year'            => ['nullable'],
        'race.last_year_url'         => ['nullable', 'string', 'max:255'],

        'description' => ['nullable'],

        'race.meta_title'       => ['nullable', 'string', 'max:255'],
        'race.meta_description' => ['nullable', 'string', 'max:255'],

        'social_media.*.name'  => ['nullable', 'string'],
        'social_media.*.value' => ['nullable', 'string'],

        'sponsors.*.name'  => ['nullable', 'string'],
        'sponsors.*.image' => ['nullable', 'string'],
        'sponsors.*.link'  => ['nullable', 'string'],

        'courses.*.name'    => ['nullable', 'string'],
        'courses.*.content' => ['nullable', 'string'],

        'features.*.name'  => ['nullable', 'string'],
        'features.*.value' => ['nullable', 'string'],

        'calendar.*.date'                => ['nullable'],
        'calendar.*.events.*.start_time' => ['nullable'],
        'calendar.*.events.*.end_time'   => ['nullable'],
        'calendar.*.events.*.activity'   => ['nullable', 'string'],

        'options.*.type'  => ['nullable', 'string'],
        'options.*.value' => ['nullable', 'string'],

    ];

    public function updatedDescription($value)
    {
        $this->description = $value;
    }

    public function mount()
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->race = new Race();

        $this->description = '';
    }

    public function addSocialMedia()
    {
        $this->social_media[] = [
            'name'  => '',
            'value' => '',
        ];
    }

    public function removeSocialMedia($index)
    {
        unset($this->social_media[$index]);
        $this->social_media = array_values($this->social_media);
    }

    public function addSponsor()
    {
        $this->sponsors[] = [
            'name'  => '',
            'image' => '',
            'link'  => '',
        ];
    }

    public function removeSponsor($index)
    {
        unset($this->sponsors[$index]);
        $this->sponsors = array_values($this->sponsors);
    }

    public function addFeature()
    {
        $this->features[] = '';
    }

    public function removeFeature($index)
    {
        unset($this->features[$index]);
        $this->features = array_values($this->features);
    }

    public function create()
    {
        $this->validate();

        $this->race->slug = Str::slug($this->race->name);

        if ($this->images) {
            foreach ($this->images as $image) {
                $this->race->addMedia($image->getRealPath())->toMediaCollection('local_files');
            }
        }

        $this->race->description = $this->description;

        $this->race->options = $this->options;

        $this->race->social_media = $this->social_media;

        $this->race->sponsors = $this->sponsors;

        $this->race->course = $this->courses;

        $this->race->features = $this->features;

        $this->race->calendar = $this->calendar;

        $this->race->save();

        $this->alert('success', __('Race created successfully'));

        $this->emit('refreshIndex');
    }

    public function addCourse()
    {
        $this->courses[] = [
            'name'     => '',
            'distance' => '',
            'type'     => '',
            'content'  => '',
        ];
    }

    public function removeCourse($index)
    {
        unset($this->courses[$index]);
        $this->courses = array_values($this->courses);
    }

    public function addRaceDate()
    {
        $this->calendar[] = [
            'date'   => '',
            'events' => [
                [
                    'start_time' => '',
                    'end_time'   => '',
                    'activity'   => '',
                ],
            ],
        ];
    }

    public function removeRaceDate($date)
    {
        unset($this->calendar[$date]);
    }

    public function removeRaceEvent($date, $eventIndex)
    {
        unset($this->calendar[$date]['events'][$eventIndex]);
        $this->calendar[$date]['events'] = array_values($this->calendar[$date]['events']);
    }

    public function addRaceEvent($date)
    {
        $this->calendar[$date]['events'][] = [
            'start_time' => '',
            'end_time'   => '',
            'activity'   => '',
        ];
    }

    public function addOption()
    {
        $this->options[] = [
            'type'  => '',
            'value' => '',
        ];
    }

    public function removeOption($index)
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    public function getCategoriesProperty()
    {
        return Category::select('name', 'id')->get();
    }

    public function getRaceLocationsProperty()
    {
        return RaceLocation::select('name', 'id')->get();
    }

    public function render()
    {
        return view('livewire.admin.race.create')->extends('layouts.dashboard');
    }
}
