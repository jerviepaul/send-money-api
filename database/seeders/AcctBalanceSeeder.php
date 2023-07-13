<?php

namespace Database\Seeders;

use App\Models\API\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcctBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accounts = Account::all();
        foreach ($accounts as $account) {
            $account->acct_balance = rand(1000, 100000);
            $account->save();
        }
    }
}
