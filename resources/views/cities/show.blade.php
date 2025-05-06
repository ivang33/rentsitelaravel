@extends('layouts.app')

@section('title', $city->city_name)

@section('content')
    <section class="city-page py-5 bg-light">
        <div class="container">
            <!-- Хлебные крошки -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $city->city_name }}</li>
                </ol>
            </nav>

            <!-- Хедер с названием города -->
            <div class="row mb-5 align-items-end">
                <div class="col-md-8">
                    <h1 class="fw-bold display-5">{{ $city->city_name }}</h1>
                    <p class="lead text-muted">Найдено {{ $hotels->total() }} вариантов размещения</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <button class="btn btn-outline-primary">
                        <i class="fas fa-map-marked-alt me-2"></i> Показать на карте
                    </button>
                </div>
            </div>

            <!-- Фильтры и отели -->
            <div class="row">
                    <!-- Отели -->
                    @forelse($hotels as $hotel)
                        <div class="card shadow-sm mb-4">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    @if($hotel->photo)
                                        <img src="{{ asset('storage/' . $hotel->photo) }}"
                                             class="img-fluid rounded-start h-100"
                                             alt="{{ $hotel->hotel_name }}"
                                             style="object-fit: cover; min-height: 200px;">
                                    @else
                                        <img src="{{ asset('images/default-hotel.jpg') }}"
                                             class="img-fluid rounded-start h-100"
                                             alt="Без изображения"
                                             style="object-fit: cover; min-height: 200px;">
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body h-100 d-flex flex-column">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="card-title fw-bold mb-2">{{ $hotel->hotel_name }}</h3>
                                            <div class="text-end">
                                                <div class="mb-1">
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="fas fa-star text-warning"></i>
                                                    <i class="far fa-star text-warning"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="card-text text-muted mb-2">
                                            <i class="fas fa-map-marker-alt text-primary me-1"></i>
                                            {{ $hotel->address }}
                                        </p>
                                        <p class="card-text mb-3">{{ Str::limit($hotel->description, 150) }}</p>
                                        <div class="mt-auto d-flex justify-content-between align-items-end">
                                            <div class="text-end">
                                                <a href="{{ route('hotels.show', $hotel->id) }}" class="btn btn-primary btn-sm mt-2">
                                                    Подробнее
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                    <!-- Пагинация -->
                    <div class="mt-4">
                        {{ $hotels->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .city-page {
            min-height: calc(100vh - 56px);
        }
        .card {
            border: none;
            border-radius: 10px;
        }
        .form-check-label i {
            width: 20px;
            display: inline-block;
        }
        .range-slider {
            padding: 0 10px;
        }
    </style>
@endpush
