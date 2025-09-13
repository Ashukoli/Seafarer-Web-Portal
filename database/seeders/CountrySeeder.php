<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $countries = [
            ['country_name' => 'India', 'sort' => 1],
            ['country_name' => 'United States', 'sort' => 2],
            ['country_name' => 'United Kingdom', 'sort' => 3],
            ['country_name' => 'Australia', 'sort' => 4],
            ['country_name' => 'Canada', 'sort' => 5],
        ];

        foreach ($countries as &$country) {
            $country['created_at'] = $now;
            $country['updated_at'] = $now;
        }

        DB::table('countries')->insert($countries);
    }
}
