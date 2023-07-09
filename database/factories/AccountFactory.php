<?php

namespace Database\Factories;

use App\Models\API\Bank;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::all()->pluck('id')->toArray();
        $banks = Bank::all()->pluck('id')->toArray();
        return [
            'acct_number' => fake()->unique()->randomNumber(8),
            'user_id' => fake()->randomElement($users),
            'bank_id' => fake()->randomElement($banks),
        ];
    }
}
