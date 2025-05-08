<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Apartment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{

    public function store(Request $request)
    {
        // Валидация данных
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'guest_count' => 'required|integer|min:1',
            'apartment_id' => 'required|exists:apartments,id',
        ]);

        // Получаем апартаменты
        $apartment = Apartment::findOrFail($request->apartment_id);

        // Рассчитываем количество дней
        $checkIn = \Carbon\Carbon::parse($request->check_in_date);
        $checkOut = \Carbon\Carbon::parse($request->check_out_date);
        $nights = $checkIn->diffInDays($checkOut);

        // Сумма бронирования
        $totalPrice = $apartment->price_per_night * $nights;

        // Сохраняем бронь
        Booking::create([
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'guest_count' => $request->guest_count,
            'status' => 'pending',
            'total_price' => $totalPrice,
            'apartment_id' => $apartment->id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Бронирование успешно оформлено!');
    }
}
