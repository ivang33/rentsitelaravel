<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Hotel;
use App\Models\Apartment;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'cities' => City::count(),
            'hotels' => Hotel::count(),
            'apartments' => Apartment::count(),

            // Последние 5 записей
            'recentCities' => City::latest()->take(5)->get(),
            'recentHotels' => Hotel::with('city')->latest()->take(5)->get(),
            'recentApartments' => Apartment::with('hotel')->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
