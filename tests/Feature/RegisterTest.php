<?php

namespace Tests\Feature;

use App\Models\API\Bank;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_registration_success(): void
    {
        $faker = Factory::create();
        $banks = Bank::all()->toArray();
        $response = $this->postJson('/api/register', [
            'name'=> $faker->text(),
            'email' => $faker->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'password_confirmation' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'bank_id' => intval($faker->randomElement($banks)),
            'acct_number' => strval($faker->randomNumber(8))
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'token',
                    'name',
                ],
                'message',
            ]);
    }

    public function test_registration_validation_error(): void
    {
        $response = $this->postJson('/api/register', [
            'name'=> '',
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
            'bank_id' => '',
            'acct_number' => ''
        ]);

        $response
            ->assertStatus(404)
            ->assertJsonStructure([
                'success',
                'data',
                'message',
            ]);
    }
}
