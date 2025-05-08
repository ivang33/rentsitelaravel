@extends('layouts.app')

@section('title', 'Избранные номера')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Избранные номера</h1>

        @if($favorites->isEmpty())
            <div class="alert alert-info">
                У вас пока нет избранных номеров.
            </div>
        @else
            <div class="row">
                @foreach($favorites as $favorite)
                    @php $apartment = $favorite->apartment; @endphp
                    @php $hotel = $apartment->hotel; @endphp

                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="row g-0 h-100">
                                <div class="col-md-4">
                                    @if($apartment->photo)
                                        <img src="{{ asset('storage/' . $apartment->photo) }}"
                                             class="img-fluid rounded-start h-100 w-100"
                                             alt="{{ $apartment->name_price }}"
                                             style="object-fit: cover;">
                                    @else
                                        <img src="{{ asset('images/default-room.jpg') }}"
                                             class="img-fluid rounded-start h-100 w-100"
                                             alt="Без изображения"
                                             style="object-fit: cover;">
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body d-flex flex-column h-100">
                                        <h5 class="card-title">{{ $apartment->name_price }}</h5>
                                        <p class="card-text text-muted">
                                            <i class="fas fa-hotel"></i> {{ $hotel->hotel_name }}
                                        </p>
                                        <p class="card-text">
                                            <strong>Тип:</strong> {{ $apartment->type }}<br>
                                            <strong>Цена:</strong> ₽{{ number_format($apartment->price_per_night, 0, '', ' ') }} / ночь
                                        </p>
                                        <div class="mt-auto d-flex justify-content-between align-items-center">
                                            <a href="{{ route('hotels.show', $hotel) }}" class="btn btn-sm btn-primary">
                                                Перейти к номеру
                                            </a>
                                            <form action="{{ route('favorites.destroy', $favorite) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    Удалить из избранного
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
