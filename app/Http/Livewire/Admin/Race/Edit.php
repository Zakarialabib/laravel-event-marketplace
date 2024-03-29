<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Race;

use App\Models\Category;
use App\Models\Race;
use App\Models\RaceLocation;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

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
        'race.name'                  => ['required', 'string', 'max:255'],
        'race.price'                 => ['required', 'numeric', 'max:2147483647'],
        'race.race_location_id'      => ['required', 'integer'],
        'race.category_id'           => ['required', 'integer'],
        'race.elevation_gain'        => ['nullable', 'string'],
        'race.number_of_days'        => ['required', 'numeric', 'max:2147483647'],
        'race.registration_deadline' => ['required', 'date'],
        'race.start_registration'    => ['required', 'date'],
        'race.end_registration'      => ['required', 'date'],
        'race.number_of_racers'      => ['required', 'numeric', 'max:2147483647'],
        'race.first_year'            => ['nullable'],
        'race.last_year_url'         => ['nullable', 'string', 'max:255'],
        'description'                => ['nullable'],
        'images'                     => ['nullable'],

        'race.meta_title'       => ['nullable', 'string', 'max:255'],
        'race.meta_description' => ['nullable', 'string', 'max:255'],

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

    public function updatedDescription($value): void
    {
        $this->description = $value;
    }

    public function onImagesUpdated($images): void
    {
        $this->images = $images;
    }

    public function addFeature(): void
    {
        $this->features[] = '';
    }

    public function removeFeature($index): void
    {
        unset($this->features[$index]);
        $this->features = array_values($this->features);
    }

    public function addOption(): void
    {
        $this->options[] = [
            'type'  => '',
            'value' => '',
        ];
    }

    public function removeOption($index): void
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    public function addSponsor(): void
    {
        $this->sponsors[] = [
            'name'  => '',
            'image' => '',
            'link'  => '',
        ];
    }

    public function removeSponsor($index): void
    {
        unset($this->sponsors[$index]);
        $this->sponsors = array_values($this->sponsors);
    }

    public function addSocialMedia(): void
    {
        $this->social_media[] = [
            'name'  => '',
            'value' => '',
        ];
    }

    public function removeSocialMedia($index): void
    {
        unset($this->social_media[$index]);
        $this->social_media = array_values($this->social_media);
    }

    public function addCourse(): void
    {
        $this->courses[] = [
            'name'     => '',
            'distance' => '',
            'type'     => '',
            'content'  => '',
        ];
    }

    public function removeCourse($index): void
    {
        unset($this->courses[$index]);
        $this->courses = array_values($this->courses);
    }

    public function addRaceDate(): void
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

    public function removeRaceDate($date): void
    {
        unset($this->calendar[$date]);
    }

    public function removeRaceEvent($date, $eventIndex): void
    {
        unset($this->calendar[$date]['events'][$eventIndex]);
        $this->calendar[$date]['events'] = array_values($this->calendar[$date]['events']);
    }

    public function addRaceEvent($date): void
    {
        $this->calendar[$date]['events'][] = [
            'start_time' => '',
            'end_time'   => '',
            'activity'   => '',
        ];
    }

    public function mediaDeleted(): void
    {
        $this->images = $this->race->getMedia('local_files');
    }

    public function mount($name): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->race = Race::whereName($name)->firstOrFail();

        $this->description = $this->race->description;

        $this->calendar = is_string($this->race->calendar) ? json_decode($this->race->calendar, true) : [];
        $this->social_media = is_string($this->race->social_media) ? json_decode($this->race->social_media, true) : [];
        $this->features = is_string($this->race->features) ? json_decode($this->race->features, true) : [];
        $this->courses = is_string($this->race->course) ? json_decode($this->race->course, true) : [];
        $this->sponsors = is_string($this->race->sponsors) ? json_decode($this->race->sponsors, true) : [];
        $this->options = is_string($this->race->options) ? json_decode($this->race->options, true) : [];
    }

    public function update()
    {
        $this->validate();

        if ($this->images) {
            $this->race->clearMediaCollection('local_files');

            foreach ($this->images as $image) {
                $this->race->addMedia($image)->toMediaCollection('local_files');
            }
        }

        // dd($this->images);

        $this->race->description = $this->description;

        $this->race->options = json_encode($this->options);

        $this->race->social_media = json_encode($this->social_media);

        $this->race->sponsors = json_encode($this->sponsors);

        $this->race->course = json_encode($this->courses);

        $this->race->features = json_encode($this->features);

        $this->race->calendar = json_encode($this->calendar);

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
