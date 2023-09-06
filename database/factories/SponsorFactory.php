<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Sponsor;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sponsor>
 */
class SponsorFactory extends Factory
{
    protected $model = Sponsor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'             => $this->faker->name(),
            'description'      => $this->faker->text(),
            'website_url'      => $this->faker->url(),
            'logo_image_url'   => $this->faker->imageUrl(),
            'social_media_url' => $this->faker->url(),
            'status'           => true,
        ];
    }


    public function configure()
    {
        return $this->afterCreating(function (Sponsor $sponsor) {
            $sponsor->addMediaFromUrl($this->getImageUrl(500, 500))
                ->toMediaCollection('local_files');
        });
    }
}
