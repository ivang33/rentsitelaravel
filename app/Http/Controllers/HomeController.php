<?php
namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $cities = City::all();
        return view('home', compact('cities'));
    }
}
