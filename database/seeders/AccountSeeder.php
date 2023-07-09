<?php

namespace Database\Seeders;

use App\Models\API\Bank;
use App\Models\User;
use Faker\Factory;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $users = User::all()->pluck('id');
        $banks = Bank::all()->pluck('id');

        foreach ($users as $user_id) {
            DB::table('accounts')->insert([
                'acct_number' => $faker->unique()->randomNumber(8),
                'user_id' => $user_id,
                'bank_id' => $faker->randomElement($banks),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]);
        }
    }

}
