<?php
namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function show(Hotel $hotel)
    {
        // Загрузка апартаментов, связанных с отелем
        $hotel->load('apartments');

        return view('hotels.show', compact('hotel'));
    }

}
