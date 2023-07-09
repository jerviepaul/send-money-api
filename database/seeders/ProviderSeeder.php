<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('providers')->insert([
            'name' => 'Instapay',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('providers')->insert([
            'name' => 'Pesonet',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
