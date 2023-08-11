<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Race;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Race>
 */
class RaceFactory extends Factory
{
    protected $model = Race::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'             => $this->faker->word,
            'date'             => $this->faker->date,
            'description'      => $this->faker->sentence,
            'race_location_id' => 1,
            'category_id'      => 1,
            // 'images' => \App\Helpers::addMediaFromUrlToCollection(new Race(), $this->faker->imageUrl(), 'races')->file_name,
            'slug'                  => Str::slug($this->faker->word),
            'start_registration'    => date('Y-m-d', strtotime('+1 day')),
            'end_registration'      => date('Y-m-d', strtotime('+30 day')),
            'registration_deadline' => date('Y-m-d', strtotime('+30 day')),
            'elevation_gain'        => $this->faker->randomNumber(3),
            'number_of_days'        => $this->faker->randomNumber(1),
            'number_of_racers'      => $this->faker->randomNumber(3),
            'first_year'            => true,
            'last_year_url'         => null,
            'price'                  => $this->faker->randomElement([700, 1400, 2500]),
            'images'                => null,
            'social_media'          => null,
            'sponsors'              => null,
            'course'                => null,
            'features'              => null,
            'options'               => null,
            'calendar'              => null,
            'status'                => true,
            'meta_title'            => null,
            'meta_description'      => null,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Race $race) {
            $race->addMediaFromUrl($this->getImageUrl(1200, 400))
                ->toMediaCollection('local_files');
        });
    }
}
