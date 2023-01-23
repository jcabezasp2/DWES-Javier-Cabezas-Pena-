<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
           'name' => fake()->company(),
           'description' => fake()->text(),
           //'image' => fake()->imageUrl(),
            'image' => '1674500450.jpg',
           'user_id' => \App\Models\User::all()->random(),
           'category_id' => \App\Models\Category::all()->random(),
           'created_at'=>now()
        ];
    }
}
