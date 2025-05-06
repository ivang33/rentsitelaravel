<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Hotel;

class CityController extends Controller
{
    public function show(City $city)
    {
        $hotels = Hotel::with('apartments')
            ->where('city_id', $city->id)
            ->paginate(10);

        return view('cities.show', compact('city', 'hotels'));
    }
}
