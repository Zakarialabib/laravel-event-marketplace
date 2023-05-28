<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RaceLocation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RaceLocation>
 */
class RaceLocationFactory extends Factory
{
    protected $model = RaceLocation::class;

    public function definition()
    {
        return [
            'name'        => $this->faker->name,
            'description' => $this->faker->sentence,
            'slug'        => $this->faker->slug,
            'category_id' => 1,
            'status'      => true,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (RaceLocation $raceLocation) {
            $raceLocation->addMediaFromUrl($this->faker->imageUrl())
                ->toMediaCollection('local_files');
        });
    }
}
