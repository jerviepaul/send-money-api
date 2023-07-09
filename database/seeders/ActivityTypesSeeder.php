<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivityTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            "Transactional", "Operational"
        ];

        foreach ($types as $type) {
            DB::table('activity_types')->insert([
                'type' => $type,
            ]);
        }
    }
}
