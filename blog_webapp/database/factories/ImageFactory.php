<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Smknstd\FakerPicsumImages\FakerPicsumImagesProvider;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker->addProvider(new FakerPicsumImagesProvider($this->faker));

        return [
            'url' => 'posts/' . $this->faker->image('public/storage/posts', 640, 480, false, null)
        ];
    }
}
