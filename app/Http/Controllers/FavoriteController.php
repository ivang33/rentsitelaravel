<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Apartment;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = auth()->user()->favorites()->with('apartment.hotel')->get();
        return view('favorites.index', compact('favorites'));
    }

    public function store(Apartment $apartment)
    {
        if (!auth()->user()->favorites()->where('apartment_id', $apartment->id)->exists()) {
            auth()->user()->favorites()->create([
                'apartment_id' => $apartment->id,
            ]);

            return back()->with('success', 'Номер добавлен в избранное');
        }

        return back()->with('info', 'Номер уже в избранном');
    }

    public function destroy(Favorite $favorite)
    {
        if ($favorite->user_id === auth()->id()) {
            $favorite->delete();
            return back()->with('success', 'Номер удален из избранного');
        }

        return back()->with('error', 'Ошибка удаления');
    }
}
