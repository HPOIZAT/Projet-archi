<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory {

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'author' => fake()->name(),
            'category' => fake()->word(),
            'publication_date' => fake()->date(),
            'isbn' => fake()->isbn13(),
            'description' => fake()->sentence(),
            'status' => array_rand(['AVAILABLE', 'BORROWED', 'RESERVED']),
        ];
    }
}
