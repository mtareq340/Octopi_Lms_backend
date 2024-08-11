<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PageContent>
 */
class PageContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'page_id' => 1,
            'title' => $this->faker->sentence(),
            'file' => $this->faker->imageUrl(640,480),
            'description' => $this->faker->text(),
        ];
    }
}
