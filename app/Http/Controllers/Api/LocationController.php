<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\LocationService;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    protected LocationService $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    /**
     * GET /api/cities?state_id=xx
     */
    public function getCities(Request $request)
    {
        $request->validate([
            'state_id' => 'required|integer|exists:states,id',
        ]);

        $cities = $this->locationService->getCitiesByState($request->input('state_id'));

        return response()->json([
            'success' => true,
            'data' => $cities,
        ]);
    }
}
