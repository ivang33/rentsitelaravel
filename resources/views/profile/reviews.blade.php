@extends('layouts.app')

@section('title', 'Мои отзывы')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Мои отзывы</h1>

        @if($reviews->isEmpty())
            <div class="alert alert-info">
                У вас пока нет отзывов.
            </div>
        @else
            <div class="row">
                @foreach($reviews as $review)
                    @php $apartment = $review->apartment; @endphp
                    @php $hotel = $apartment->hotel; @endphp

                    <div class="col-md-12 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <h5 class="card-title mb-0">{{ $apartment->name_price }}</h5>
                                        <p class="text-muted small mb-0">
                                            {{ $hotel->hotel_name }} •
                                            {{ $review->review_date->format('d.m.Y') }}
                                        </p>
                                    </div>
                                    <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="delete-review-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i> Удалить
                                        </button>
                                    </form>
                                </div>
                                <p class="card-text mt-2">{{ $review->review_text }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Пагинация -->
            <div class="d-flex justify-content-center mt-4">
                {{ $reviews->links() }}
            </div>
        @endif
    </div>
@endsection
