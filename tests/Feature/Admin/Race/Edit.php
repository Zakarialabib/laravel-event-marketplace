<?php

use App\Http\Livewire\Admin\Race\Edit;
use App\Models\Category;
use App\Models\Race;
use App\Models\RaceLocation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('can update race', function () {
    $race = Race::factory()->create();

    $category = Category::factory()->create();
    $location = RaceLocation::factory()->create();

    Livewire::test(Edit::class)
        ->set('race', $race)
        ->set('race.name', 'New Race Name')
        ->set('race.date', '2022-01-01')
        ->set('race.price', 100)
        ->set('race.race_location_id', $location->id)
        ->set('race.category_id', $category->id)
        ->set('race.number_of_days', 2)
        ->set('race.number_of_racers', 10)
        ->set('description', 'New Race Description')
        ->set('images', [UploadedFile::fake()->image('image.jpg')])
        ->call('update');

    $race->refresh();

    expect($race->name)->toBe('New Race Name');
    expect($race->date)->toBe('2022-01-01');
    expect($race->price)->toBe(100);
    expect($race->race_location_id)->toBe($location->id);
    expect($race->category_id)->toBe($category->id);
    expect($race->number_of_days)->toBe(2);
    expect($race->number_of_racers)->toBe(10);
    expect($race->description)->toBe('New Race Description');
    expect($race->getMedia('local_files')->count())->toBe(1);
});

test('can add and remove sponsors', function () {
    $race = Race::factory()->create();

    Livewire::test(Edit::class)
        ->set('race', $race)
        ->call('addSponsor')
        ->assertSet('sponsors', [['name' => '', 'image' => '', 'link' => '']])
        ->call('removeSponsor', 0)
        ->assertSet('sponsors', []);
});

test('can add and remove social media links', function () {
    $race = Race::factory()->create();

    Livewire::test(Edit::class)
        ->set('race', $race)
        ->call('addSocialMedia')
        ->assertSet('social_media', [['name' => '', 'value' => '']])
        ->call('removeSocialMedia', 0)
        ->assertSet('social_media', []);
});

test('can add and remove courses', function () {
    $race = Race::factory()->create();

    Livewire::test(Edit::class)
        ->set('race', $race)
        ->call('addCourse')
        ->assertSet('courses', [['name' => '', 'content' => '']])
        ->call('removeCourse', 0)
        ->assertSet('courses', []);
});

test('can add and remove features', function () {
    $race = Race::factory()->create();

    Livewire::test(Edit::class)
        ->set('race', $race)
        ->call('addFeature')
        ->assertSet('features', [''])
        ->call('removeFeature', 0)
        ->assertSet('features', []);
});

test('can add and remove options', function () {
    $race = Race::factory()->create();

    Livewire::test(Edit::class)
        ->set('race', $race)
        ->call('addOption')
        ->assertSet('options', [['type' => '', 'value' => '']])
        ->call('removeOption', 0)
        ->assertSet('options', []);
});

test('can add and remove race dates and events', function () {
    $race = Race::factory()->create();

    Livewire::test(Edit::class)
        ->set('race', $race)
        ->call('addRaceDate')
        ->assertSet('calendar', [['date' => '', 'events' => [['start_time' => '', 'end_time' => '', 'activity' => '']]]])
        ->call('addRaceEvent', 0)
        ->assertSet('calendar', [['date' => '', 'events' => [['start_time' => '', 'end_time' => '', 'activity' => ''], ['start_time' => '', 'end_time' => '', 'activity' => '']]]])
        ->call('removeRaceEvent', 0, 0)
        ->assertSet('calendar', [['date' => '', 'events' => [['start_time' => '', 'end_time' => '', 'activity' => '']]]])
        ->call('removeRaceDate', 0)
        ->assertSet('calendar', []);
});