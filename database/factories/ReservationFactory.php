<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory {

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>     */
    public function definition(): array
    {
        $reservation_end_date = fake()->date();
        return [
            'user_id' => User::all()->random()->id,
            'book_id' => Book::all()->random()->id,
            'reservation_start_date' => fake()->date('Y-m-d', $reservation_end_date),
            'reservation_end_date' => $reservation_end_date,
            'condition' => fake()->sentence(),
            'status' => array_rand(['AVAILABLE', 'NOT_AVAILABLE']),
        ];
    }
}
