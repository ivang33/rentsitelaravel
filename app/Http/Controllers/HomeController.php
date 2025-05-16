<?php
namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index()
    {
        // Получаем все города
        $cities = City::all();

        // Проверяем, есть ли города в коллекции
        if ($cities->isEmpty()) {
            // Если городов нет, создаем пустую коллекцию
            $randomCities = collect([]);
        } else {
            // Если городов меньше 3, выбираем все доступные
            if ($cities->count() < 3) {
                $randomCities = $cities;
            } else {
                // Выбираем 3 случайных города
                $randomCities = $cities->random(3);
            }
        }

        return view('home', [
            'cities' => $randomCities,
        ]);
    }
}
