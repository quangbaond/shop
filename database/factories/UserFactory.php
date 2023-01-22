<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name;
        return [
            'name' => $name,
            'email' => fake()->unique()->safeEmail(),
            'username' => fake()->unique()->username(),
            'avatar' => fake()->imageUrl('50px', '50', '', true, $name, false),
            'address' => fake()->address(),
            'number_phone' => fake()->phoneNumber(),
            'status' => fake()->numberBetween(0,1),
            'email_verified_at' => now(),
            'password' => Hash::make('baooibao1'), // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
