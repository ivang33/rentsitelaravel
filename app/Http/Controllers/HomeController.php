<?php
namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index()
    {
        $cities = City::all(); // Получаем все города
        $randomCities = $cities->random(3); // Выбираем 3 случайных города

        return view('home', [
            'cities' => $randomCities,
        ]);
    }
}
