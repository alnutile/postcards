<?php

namespace Database\Factories;

use App\Models\Postcard;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Postcard>
 */
class PostcardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'recipient_name' => fake()->name(),
            'street_1' => fake()->streetAddress(),
            'street_2' => fake()->optional(0.3)->secondaryAddress(),
            'city' => fake()->city(),
            'state' => fake()->stateAbbr(),
            'zip_code' => fake()->postcode(),
            'message' => fake()->paragraph(),
            'filename' => fake()->uuid().'.jpg',
            'user_id' => User::factory(),
        ];
    }
}
