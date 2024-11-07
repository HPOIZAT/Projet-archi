<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Book;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(50)->create();

        User::factory()->create([
            'firstname' => 'Hugo',
            'lastname' => 'Poizat',
            'phone_number' => '0606060606',
            'email' => 'test@email.com',
            'signed_in_at' => now(),
            'password' => 'password',
            'status' => 'ACTIVE',
        ]);

        Book::factory(25)->create();

        Reservation::factory(5)->create();
    }
}
