<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\State;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            "Maharashtra" => ["Mumbai", "Pune", "Nagpur", "Nashik", "Aurangabad"],
            "Delhi" => ["New Delhi"],
            "Karnataka" => ["Bengaluru", "Mysuru", "Mangalore", "Hubli", "Belgaum"],
            "Tamil Nadu" => ["Chennai", "Coimbatore", "Madurai", "Tiruchirappalli", "Salem"],
            "Uttar Pradesh" => ["Lucknow", "Kanpur", "Varanasi", "Agra", "Prayagraj"],
            "West Bengal" => ["Kolkata", "Howrah", "Durgapur", "Asansol", "Siliguri"],
            "Gujarat" => ["Ahmedabad", "Surat", "Vadodara", "Rajkot", "Bhavnagar"],
            "Rajasthan" => ["Jaipur", "Udaipur", "Jodhpur", "Kota", "Ajmer"],
            "Madhya Pradesh" => ["Bhopal", "Indore", "Gwalior", "Jabalpur", "Ujjain"],
            "Bihar" => ["Patna", "Gaya", "Bhagalpur", "Muzaffarpur"],
            "Punjab" => ["Amritsar", "Ludhiana", "Jalandhar", "Patiala"],
            "Haryana" => ["Gurgaon", "Faridabad", "Panipat", "Ambala"],
            "Kerala" => ["Kochi", "Thiruvananthapuram", "Kozhikode", "Thrissur"],
            "Andhra Pradesh" => ["Visakhapatnam", "Vijayawada", "Guntur", "Nellore"],
            "Telangana" => ["Hyderabad", "Warangal", "Nizamabad"],
            "Odisha" => ["Bhubaneswar", "Cuttack", "Rourkela", "Sambalpur"],
            "Chhattisgarh" => ["Raipur", "Bhilai", "Bilaspur", "Korba"],
            "Jharkhand" => ["Ranchi", "Jamshedpur", "Dhanbad", "Hazaribagh"],
            "Assam" => ["Guwahati", "Silchar", "Dibrugarh", "Jorhat"],
            "Goa" => ["Panaji", "Margao", "Vasco da Gama", "Mapusa"],
        ];

        foreach ($cities as $stateName => $cityList) {
            $state = State::where('state_name', $stateName)->first();
            if ($state) {
                foreach ($cityList as $city) {
                    City::create([
                        'state_id' => $state->id,
                        'city_name' => $city,
                        'status' => 1,
                    ]);
                }
            }
        }
    }
}
