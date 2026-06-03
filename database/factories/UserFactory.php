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
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'u_name' => fake()->name(),
            'u_phone' => fake()->phoneNumber(),
            'u_gender' => fake()->randomElement(['male', 'female', 'other']),
            'u_address' => fake()->address(),
            'u_email' => fake()->unique()->safeEmail(),
            'u_password' => static::$password ??= Hash::make('password'),
            'u_dob' => fake()->date(),
            'u_role' => fake()->randomElement(['admin', 'staff']),
            'u_status' => fake()->randomElement(['active', 'inactive']),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'u_email' => null,
        ]);
    }
}
