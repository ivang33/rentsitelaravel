<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::with('city')->latest()->paginate(10);
        return view('admin.hotels.index', compact('hotels'));
    }

    public function create()
    {
        $cities = \App\Models\City::all();
        return view('admin.hotels.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hotel_name' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'stars' => 'required|integer|min:1|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('image')) {
            $photoPath = $request->file('image')->store('hotels', 'public');
        }

        Hotel::create([
            'hotel_name' => $request->hotel_name,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'description' => $request->description,
            'stars' => $request->stars,
            'photo' => $photoPath,
        ]);

        return redirect()->route('admin.hotels.index')->with('success', 'Отель успешно добавлен');
    }

    public function edit(Hotel $hotel)
    {
        $cities = \App\Models\City::all();
        return view('admin.hotels.edit', compact('hotel', 'cities'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $validated = $request->validate([
            'hotel_name' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'stars' => 'required|integer|min:1|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($hotel->photo) {
                Storage::disk('public')->delete($hotel->photo);
            }
            $validated['photo'] = $request->file('image')->store('hotels', 'public');
        }

        $hotel->update($validated);

        return redirect()->route('admin.hotels.index')
            ->with('success', 'Отель успешно обновлен');
    }

    public function destroy(Hotel $hotel)
    {
        if ($hotel->photo) {
            Storage::disk('public')->delete($hotel->photo);
        }

        $hotel->delete();

        return redirect()->route('admin.hotels.index')
            ->with('success', 'Отель успешно удален');
    }
}
