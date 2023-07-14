<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'           => $this->faker->randomElement(['Triatlón', 'Ciclismo', 'Running', 'Natación', 'Trail', 'Outdoor']),
            'description'    => $this->faker->sentence,
            'slug'             => Str::slug($this->faker->randomElement(['Triatlón', 'Ciclismo', 'Running', 'Natación', 'Trail', 'Outdoor'])).'-'.Str::random(5),
            'type'             => $this->faker->word,
            'status'      => true,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Category $category) {
            $category->addMediaFromUrl($this->getImageUrl(500, 500))
                ->toMediaCollection('local_files');
        });
    }
}
