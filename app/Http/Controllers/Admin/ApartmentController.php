<?php

namespace App\Http\Controllers\Admin;

use App\Models\Apartment;
use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    public function create()
    {
        // Получаем список всех отелей с их названиями
        $hotels = Hotel::all(); // Здесь важно, чтобы отображалось hotel->hotel_name

        return view('admin.apartments.create', compact('hotels'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'room_number' => 'required|string|max:50|unique:apartments',
            'type' => 'required|string|max:100',
            'price_per_night' => 'required|numeric|min:0',
            'room_count' => 'required|integer|min:1',
            'capacity' => 'required|integer|min:1',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'description' => 'nullable|string',
            'descriptions' => 'nullable|string',
            'additional_info' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'name_price' => 'required|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $validated['photo'] = $request->file('image')->store('apartments', 'public');
        }

        Apartment::create($validated);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Апартаменты успешно созданы');
    }

    public function edit(Apartment $apartment)
    {
        // Получаем список всех отелей с их названиями
        $hotels = Hotel::all(); // Здесь важно, чтобы отображалось hotel->hotel_name

        return view('admin.apartments.edit', compact('apartment', 'hotels'));
    }

    public function update(Request $request, Apartment $apartment)
    {
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'room_number' => 'required|string|max:50|unique:apartments,room_number,' . $apartment->id,
            'type' => 'required|string|max:100',
            'price_per_night' => 'required|numeric|min:0',
            'room_count' => 'required|integer|min:1',
            'capacity' => 'required|integer|min:1',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'description' => 'nullable|string',
            'descriptions' => 'nullable|string',
            'additional_info' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'name_price' => 'required|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            if ($apartment->photo) {
                Storage::disk('public')->delete($apartment->photo);
            }
            $validated['photo'] = $request->file('image')->store('apartments', 'public');
        }

        $apartment->update($validated);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Апартаменты успешно обновлены');
    }

    public function destroy(Apartment $apartment)
    {
        if ($apartment->photo) {
            Storage::disk('public')->delete($apartment->photo);
        }

        $apartment->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Апартаменты успешно удалены');
    }
}
