<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Slider;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slider>
 */
class SliderFactory extends Factory
{
    protected $model = Slider::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subtitle'    => $this->faker->sentence,
            'title'       => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'bg_color'    => 'bg-white',
            'text_color'  => 'text-black',
            'featured'    => true,
            'link'        => $this->faker->url,
        ];
    }

      /**
       * Configure the model factory.
       *
       * @return $this
       */
    public function configure()
    {
        return $this->afterCreating(function (Slider $slider) {
            $slider->addMediaFromUrl($this->faker->imageUrl())
                ->toMediaCollection('local_files');
        });
    }
}
