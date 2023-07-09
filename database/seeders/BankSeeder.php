<?php

namespace Database\Seeders;

use DateTime;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $banks = [
            "BDO UNIBANK INC",
            "LAND BANK OF THE PHILIPPINES",
            "BANK OF THE PHIL ISLANDS",
            "METROPOLITAN BANK & TCO",
            "CHINA BANKING CORP",
            "RIZAL COMM'L BANKING CORP",
            "PHIL NATIONAL BANK",
            "DEVELOPMENT BANK OF THE PHIL",
            "UNION BANK OF THE PHILS",
            "SECURITY BANK CORP",
            "EAST WEST BANKING CORP",
            "CITIBANK, N.A.",
            "ASIA UNITED BANK CORPORATION",
            "HONGKONG & SHANGHAI BANKING CORP",
            "BANK OF COMMERCE",
            "ROBINSONS BANK CORPORATION",
            "PHIL TRUST COMPANY",
            "PHIL BANK OF COMMUNICATIONS",
            "STANDARD CHARTERED BANK",
            "MIZUHO BANK LTD - MANILA BRANCH",
            "MUFG BANK, LTD.",
            "MAYBANK PHILIPPINES INCORPORATED",
            "CTBC BANK (PHILIPPINES) CORP",
            "PHILIPPINE VETERANS BANK",
            "JP MORGAN CHASE BANK NATIONAL ASSN.",
            "BANK OF CHINA (HONGKONG) LIMITED-MANILA BRANCH",
            "DEUTSCHE BANK AG",
            "SUMITOMO MITSUI BANKING CORPORATION-MANILA BRANCH",
            "AUSTRALIA AND NEW ZEALAND BANKING GROUP LIMITED",
            "BDO PRIVATE BANK, INC.",
            "KEB HANA BANK - MANILA BRANCH",
            "CIMB BANK PHILIPPINES INC",
            "BANK OF AMERICA N.A.",
            "ING BANK N.V.",
            "MEGA INT'L COMM'L BANK CO LTD",
            "BANGKOK BANK PUBLIC COMPANY LIMITED",
            "INDUSTRIAL AND COMMERCIAL BANK OF CHINA LIMITED - MANILA BRA",
            "SHINHAN BANK - MANILA BRANCH",
            "INDUSTRIAL BANK OF KOREA MANILA BRANCH",
            "HUA NAN COMMERCIAL BANK LTD MANILA BRANCH",
            "CATHAY UNITED BANK CO LTD - MANILA BRANCH",
            "UNITED OVERSEAS BANK LIMITED MANILA BRANCH",
            "CHANG HWA COMMERCIAL BANK LTD - MANILA BRANCH",
            "FIRST COMMERCIAL BANK LTD MANILA BRANCH",
            "AL-AMANAH ISLAMIC INVESTMENT BANK OF THE PHILS",
        ];

        $providers = DB::table('providers')->pluck('id');
        foreach($banks as $bank) {
            DB::table('banks')->insert([
                'name' => $bank,
                'provider_id' => $faker->randomElement($providers),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]);
        }
    }
}
