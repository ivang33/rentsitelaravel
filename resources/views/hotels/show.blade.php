@extends('layouts.app')
@section('title', $hotel->hotel_name)
@section('content')
    <div class="container py-5">
        <!-- Хлебные крошки -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cities.show', $hotel->city_id) }}">{{ $hotel->city->city_name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $hotel->hotel_name }}</li>
            </ol>
        </nav>

        <!-- Заголовок и основные данные -->
        <div class="row mb-4">
            <div class="col-md-8">
                <h1 class="fw-bold mb-3">{{ $hotel->hotel_name }}</h1>
                <div class="d-flex align-items-center mb-3">
                    <span class="badge bg-primary me-2">Рейтинг: 4.5</span>
                    <span class="text-muted"><i class="fas fa-map-marker-alt me-1"></i> {{ $hotel->address }}</span>
                </div>
            </div>
            <div class="col-md-4 text-md-end">
                <button class="btn btn-outline-primary me-2">
                    <i class="far fa-heart"></i> В избранное
                </button>
            </div>
        </div>

        <!-- Галерея изображений -->
        <div class="row mb-5">
            <div class="col-12">
                @if($hotel->photo)
                    <img src="{{ asset('storage/' . $hotel->photo) }}"
                         class="img-fluid rounded-3 shadow-sm w-100"
                         alt="{{ $hotel->hotel_name }}"
                         style="max-height: 500px; object-fit: cover;">
                @else
                    <img src="{{ asset('images/default-hotel.jpg') }}"
                         class="img-fluid rounded-3 shadow-sm w-100"
                         alt="Без изображения"
                         style="max-height: 500px; object-fit: cover;">
                @endif
            </div>
        </div>

        <!-- Основной контент -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title fw-bold mb-4">Описание отеля</h3>
                        <p class="card-text lead">{{ $hotel->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Список апартаментов -->
    @if($hotel->apartments->isNotEmpty())
        <div class="row mt-5">
            <div class="col-12">
                <h2 class="mb-4">Доступные апартаменты</h2>
            </div>

            @foreach($hotel->apartments as $apartment)
                <div class="col-md-12 mb-4">
                    <div class="card shadow-sm">
                        <div class="row g-0">
                            <div class="col-md-4">
                                @if($apartment->photo)
                                    <img src="{{ asset('storage/' . $apartment->photo) }}"
                                         class="img-fluid rounded-start h-100"
                                         alt="{{ $apartment->name_price }}"
                                         style="object-fit: cover; min-height: 150px;">
                                @else
                                    <img src="{{ asset('images/default-apartment.jpg') }}"
                                         class="img-fluid rounded-start h-100"
                                         alt="Без изображения"
                                         style="object-fit: cover; min-height: 150px;">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="card-body d-flex flex-column h-100">
                                    <h5 class="card-title fw-bold">{{ $apartment->name_price }}</h5>
                                    <p class="card-text text-muted">
                                        {{ $apartment->type }} • {{ $apartment->room_count }} комнат(а), до {{ $apartment->capacity }} чел.
                                    </p>
                                    <p class="card-text">{{ Str::limit($apartment->descriptions, 100) }}</p>
                                    <div class="mt-auto d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="badge bg-success fs-6">₽{{ number_format($apartment->price_per_night, 0, '', ' ') }}/ночь</span>
                                        </div>
                                        <a href="{{ route('apartments.show', $apartment->id) }}" class="btn btn-primary btn-sm">
                                            Подробнее
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info mt-5">
            В этом отеле пока нет доступных апартаментов.
        </div>
    @endif
@endsection

@push('styles')
    <style>
        .breadcrumb {
            background-color: transparent;
            padding: 0;
        }
        .card {
            border-radius: 10px;
        }
        .sticky-top {
            z-index: 1;
        }
    </style>
@endpush
