<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Hotel;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'city' => 'required|string|max:255',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',

        ]);

        $cityName = $request->input('city');

        // Ищем город по точному совпадению названия
        $city = City::where('city_name', $cityName)->first();

        if (!$city) {
            return back()->with('error', 'Город не найден');
        }

        // Перенаправляем на страницу города
        return redirect()->route('cities.show', ['city' => $city->id]);
    }

    public function show(City $city)
    {
        $hotels = Hotel::with('apartments')
            ->where('city_id', $city->id)
            ->paginate(10);

        return view('cities.show', compact('city', 'hotels'));
    }
}
