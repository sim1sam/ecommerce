<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CountryState;
use App\Models\City;
use Illuminate\Http\Request;

class PublicLocationController extends Controller
{
    /**
     * Get states by country ID
     */
    public function getStatesByCountry($country)
    {
        try {
            $states = CountryState::where('country_id', $country)
                                 ->where('status', 1)
                                 ->select('id', 'name')
                                 ->get();
            
            return response()->json($states);
        } catch (\Exception $e) {
            \Log::error('Error loading states for country ' . $country . ': ' . $e->getMessage());
            return response()->json(['error' => 'Failed to load states'], 500);
        }
    }

    /**
     * Get cities by state ID
     */
    public function getCitiesByState($state)
    {
        try {
            $cities = City::where('country_state_id', $state)
                         ->where('status', 1)
                         ->select('id', 'name')
                         ->get();
            
            return response()->json($cities);
        } catch (\Exception $e) {
            \Log::error('Error loading cities for state ' . $state . ': ' . $e->getMessage());
            return response()->json(['error' => 'Failed to load cities'], 500);
        }
    }
}