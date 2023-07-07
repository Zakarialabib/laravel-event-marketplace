<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Race;

use App\Models\Category;
use App\Models\Race;
use App\Models\RaceLocation;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Redirector;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $listeners = [
        'imagesUpdated' => 'onImagesUpdated',
        'mediaDeleted',
    ];

    public $race;

    public $images = [];

    public $options = [];

    public $social_media = [];

    public $sponsors = [];

    public $courses = [];

    public $features = [];

    public $calendar = [];

    public $description;

    public array $listsForFields = [];

    protected $rules = [

        'race.name'             => ['required', 'string', 'max:255'],
        'race.date'             => ['required', 'date', 'max:255'],
        'race.price'            => ['required', 'numeric', 'max:2147483647'],
        'race.race_location_id' => ['required', 'integer'],
        'race.category_id'      => ['required', 'integer'],
        'race.number_of_days'   => ['required', 'numeric', 'max:2147483647'],
        'race.registration_deadline'   => ['required','date'],
        'race.number_of_racers' => ['required', 'numeric', 'max:2147483647'],
        'description'           => ['nullable'],
        'images'    => [ 'nullable'],

        // 'race.meta_title'       => ['nullable', 'string', 'max:255'],
        // 'race.meta_description' => ['nullable', 'string', 'max:255'],

        'social_media.*.name'  => ['nullable'],
        'social_media.*.value' => ['nullable'],

        'sponsors.*.name'  => ['nullable'],
        'sponsors.*.image' => ['nullable'],
        'sponsors.*.link'  => ['nullable'],

        'courses.*.name'    => ['nullable'],
        'courses.*.content' => ['nullable'],

        'features.*' => ['nullable'],

        'calendar.*.date'                => ['nullable'],
        'calendar.*.events.*.start_time' => ['nullable'],
        'calendar.*.events.*.end_time'   => ['nullable'],
        'calendar.*.events.*.activity'   => ['nullable'],

        'options.*.type'  => ['nullable'],
        'options.*.value' => ['nullable'],

    ];

    public function updatedDescription($value)
    {
        $this->description = $value;
    }

    public function onImagesUpdated($images): void
    {
        $this->images = $images;
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

    public function addCourse()
    {
        $this->courses[] = [
            'name'    => '',
            'content' => '',
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

    public function mediaDeleted(): void
    {
        $this->images = $this->product->getMedia('local_files');
    }

    public function mount($name)
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->race = Race::whereName($name)->firstOrFail();

        $this->description = $this->race->description;

        $this->options = $this->race->options ?? [];

        $this->calendar = $this->race->calendar ?? [];
        $this->social_media = $this->race->social_media ?? [];
        $this->features = $this->race->features ?? [];
        $this->courses = $this->race->course ?? [];
        $this->sponsors = $this->race->sponsors ?? [];

        $this->images = $this->race->getMedia('local_files');
    }

    public function update()
    {
        $this->validate();

        if (empty($this->images)) {
            foreach ($this->images as $image) {
                $this->race->addMedia($image)->toMediaCollection('local_files');
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

        $this->alert('success', __('Race updated successfully'));

        return redirect()->route('admin.races');
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
        return view('livewire.admin.race.edit')->extends('layouts.dashboard');
    }
}
