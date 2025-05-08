<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'review_text' => 'required|string|max:1000',
            'apartment_id' => 'required|exists:apartments,id'
        ]);

        Review::create([
            'review_text' => $validated['review_text'],
            'review_date' => now(), // Это уже объект Carbon
            'user_id' => auth()->id(),
            'apartment_id' => $validated['apartment_id']
        ]);

        return back()->with('success', 'Отзыв успешно добавлен!');
    }

    public function destroy(Review $review)
    {
        if ($review->user_id !== auth()->id()) {
            abort(403);
        }

        $review->delete();
        return back()->with('success', 'Отзыв удалён!');
    }
    public function myReviews()
    {
        $reviews = Review::with(['apartment.hotel'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(5); // По 5 отзывов на страницу

        return view('profile.reviews', compact('reviews'));
    }
}
