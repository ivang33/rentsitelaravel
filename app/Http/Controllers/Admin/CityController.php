<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::latest()->paginate(10);
        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
        return view('admin.cities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'city_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Загрузка изображения
        $photoPath = null;
        if ($request->hasFile('image')) {
            $photoPath = $request->file('image')->store('cities', 'public');
        }

        City::create([
            'city_name' => $request->city_name,
            'description' => $request->description,
            'photo' => $photoPath,
        ]);

        return redirect()->route('admin.cities.index')->with('success', 'Город успешно добавлен');
    }

    public function edit(City $city)
    {
        return view('admin.cities.edit', compact('city'));
    }

    public function update(Request $request, City $city)
    {
        $validated = $request->validate([
            'city_name' => 'required|string|max:255|unique:cities,city_name,'.$city->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Удаляем старое изображение, если есть
            if ($city->image) {
                Storage::disk('public')->delete($city->image);
            }

            $imagePath = $request->file('image')->store('cities', 'public');
            $validated['image'] = $imagePath;
        }

        $city->update($validated);

        return redirect()->route('admin.cities.index')
            ->with('success', 'Город успешно обновлен');
    }

    public function destroy(City $city)
    {
        if ($city->image) {
            Storage::disk('public')->delete($city->image);
        }

        $city->delete();

        return redirect()->route('admin.cities.index')
            ->with('success', 'Город успешно удален');
    }
}
