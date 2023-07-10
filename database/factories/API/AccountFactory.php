<?php

namespace Database\Factories\API;

use App\Models\API\Bank;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\API\Account>
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
        return [
            'user_id' => User::factory(),
            'acct_number' => fake()->unique()->randomNumber(8),
            'acct_balance' => fake()->randomFloat(2,100,100000),
            'bank_id' => Bank::factory(),
        ];
    }
}
