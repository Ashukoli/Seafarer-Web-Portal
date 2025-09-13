<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StateSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $states = [
            // ---------------- INDIA ----------------
            ['country_id' => 1, 'state_name' => 'Andhra Pradesh', 'sort' => 1],
            ['country_id' => 1, 'state_name' => 'Arunachal Pradesh', 'sort' => 2],
            ['country_id' => 1, 'state_name' => 'Assam', 'sort' => 3],
            ['country_id' => 1, 'state_name' => 'Bihar', 'sort' => 4],
            ['country_id' => 1, 'state_name' => 'Chhattisgarh', 'sort' => 5],
            ['country_id' => 1, 'state_name' => 'Goa', 'sort' => 6],
            ['country_id' => 1, 'state_name' => 'Gujarat', 'sort' => 7],
            ['country_id' => 1, 'state_name' => 'Haryana', 'sort' => 8],
            ['country_id' => 1, 'state_name' => 'Himachal Pradesh', 'sort' => 9],
            ['country_id' => 1, 'state_name' => 'Jharkhand', 'sort' => 10],
            ['country_id' => 1, 'state_name' => 'Karnataka', 'sort' => 11],
            ['country_id' => 1, 'state_name' => 'Kerala', 'sort' => 12],
            ['country_id' => 1, 'state_name' => 'Madhya Pradesh', 'sort' => 13],
            ['country_id' => 1, 'state_name' => 'Maharashtra', 'sort' => 14],
            ['country_id' => 1, 'state_name' => 'Manipur', 'sort' => 15],
            ['country_id' => 1, 'state_name' => 'Meghalaya', 'sort' => 16],
            ['country_id' => 1, 'state_name' => 'Mizoram', 'sort' => 17],
            ['country_id' => 1, 'state_name' => 'Nagaland', 'sort' => 18],
            ['country_id' => 1, 'state_name' => 'Odisha', 'sort' => 19],
            ['country_id' => 1, 'state_name' => 'Punjab', 'sort' => 20],
            ['country_id' => 1, 'state_name' => 'Rajasthan', 'sort' => 21],
            ['country_id' => 1, 'state_name' => 'Sikkim', 'sort' => 22],
            ['country_id' => 1, 'state_name' => 'Tamil Nadu', 'sort' => 23],
            ['country_id' => 1, 'state_name' => 'Telangana', 'sort' => 24],
            ['country_id' => 1, 'state_name' => 'Tripura', 'sort' => 25],
            ['country_id' => 1, 'state_name' => 'Uttar Pradesh', 'sort' => 26],
            ['country_id' => 1, 'state_name' => 'Uttarakhand', 'sort' => 27],
            ['country_id' => 1, 'state_name' => 'West Bengal', 'sort' => 28],
            // Union Territories
            ['country_id' => 1, 'state_name' => 'Andaman and Nicobar Islands', 'sort' => 29],
            ['country_id' => 1, 'state_name' => 'Chandigarh', 'sort' => 30],
            ['country_id' => 1, 'state_name' => 'Dadra and Nagar Haveli and Daman and Diu', 'sort' => 31],
            ['country_id' => 1, 'state_name' => 'Delhi', 'sort' => 32],
            ['country_id' => 1, 'state_name' => 'Jammu and Kashmir', 'sort' => 33],
            ['country_id' => 1, 'state_name' => 'Ladakh', 'sort' => 34],
            ['country_id' => 1, 'state_name' => 'Lakshadweep', 'sort' => 35],
            ['country_id' => 1, 'state_name' => 'Puducherry', 'sort' => 36],

            // ---------------- USA ----------------
            ['country_id' => 2, 'state_name' => 'California', 'sort' => 1],
            ['country_id' => 2, 'state_name' => 'Texas', 'sort' => 2],
            ['country_id' => 2, 'state_name' => 'New York', 'sort' => 3],
            ['country_id' => 2, 'state_name' => 'Florida', 'sort' => 4],
            ['country_id' => 2, 'state_name' => 'Illinois', 'sort' => 5],

            // ---------------- UK ----------------
            ['country_id' => 3, 'state_name' => 'England', 'sort' => 1],
            ['country_id' => 3, 'state_name' => 'Scotland', 'sort' => 2],
            ['country_id' => 3, 'state_name' => 'Wales', 'sort' => 3],
            ['country_id' => 3, 'state_name' => 'Northern Ireland', 'sort' => 4],

            // ---------------- Australia ----------------
            ['country_id' => 4, 'state_name' => 'New South Wales', 'sort' => 1],
            ['country_id' => 4, 'state_name' => 'Victoria', 'sort' => 2],
            ['country_id' => 4, 'state_name' => 'Queensland', 'sort' => 3],
            ['country_id' => 4, 'state_name' => 'Western Australia', 'sort' => 4],
            ['country_id' => 4, 'state_name' => 'South Australia', 'sort' => 5],

            // ---------------- Canada ----------------
            ['country_id' => 5, 'state_name' => 'Ontario', 'sort' => 1],
            ['country_id' => 5, 'state_name' => 'Quebec', 'sort' => 2],
            ['country_id' => 5, 'state_name' => 'British Columbia', 'sort' => 3],
            ['country_id' => 5, 'state_name' => 'Alberta', 'sort' => 4],
            ['country_id' => 5, 'state_name' => 'Manitoba', 'sort' => 5],
        ];

        foreach ($states as &$state) {
            $state['created_at'] = $now;
            $state['updated_at'] = $now;
        }

        DB::table('states')->insert($states);
    }
}
