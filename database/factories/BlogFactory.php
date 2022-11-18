<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->sentence(rand(3,8));

        return [
            'user_id' => rand(1,10),
            'title' => $title,
            'slug' => Str::slug($title),
            'subject' => fake()->paragraph(rand(3,10))
        ];
    }
}
