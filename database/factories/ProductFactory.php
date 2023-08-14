<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'             => $this->faker->word,
            'description'      => $this->faker->sentence,
            'price'            => $this->faker->randomFloat(2, 10, 100),
            'discount_price'   => $this->faker->randomFloat(2, 10, 100),
            'code'             => Str::random(5),
            'category_id'      => 1,
            'brand_id'      => 1,
            'slug'             => Str::slug($this->faker->word).'-'.Str::random(5),
            'meta_title'       => $this->faker->word,
            'meta_description' => Str::limit($this->faker->sentence, 165),
            'options'          => json_encode([
                [
                    'type'  => 'color',
                    'value' => $this->faker->randomElement(['#000000', '#ffffff', '#ff0000', '#00ff00', '#0000ff']),
                ],
                [
                    'type'  => 'size',
                    'value' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
                ],
            ]),

            'status' => true,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            $product->addMediaFromUrl($this->getImageUrl(1000, 1000))
                ->toMediaCollection('local_files');
        });
    }
}
