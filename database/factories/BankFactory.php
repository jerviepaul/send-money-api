<?php

namespace Database\Factories;

use App\Models\API\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BankFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $provider = Provider::all()->pluck('id')->toArray();
        return [
            'name' => fake()->text(),
            'provider_id' => fake()->randomElement($provider),
        ];
    }
}
