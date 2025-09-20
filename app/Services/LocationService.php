<?php

namespace App\Services;

use App\Models\City;

class LocationService
{
    /**
     * Get all cities by state_id
     *
     * @param int $stateId
     * @return \Illuminate\Support\Collection
     */
    public function getCitiesByState(int $stateId)
    {
        return City::where('state_id', $stateId)
            ->orderBy('city_name')
            ->get(['id', 'city_name']);
    }
}
