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
                    <div class="card shadow-sm position-relative">
                        <!-- Верхняя часть карточки -->
                        <div class="row g-0">
                            <div class="col-md-4">
                                @if($apartment->photo)
                                    <img src="{{ asset('storage/' . $apartment->photo) }}"
                                         class="img-fluid rounded-start h-100"
                                         style="object-fit: cover; min-height: 150px;">
                                @else
                                    <img src="{{ asset('images/default-apartment.jpg') }}"
                                         class="img-fluid rounded-start h-100"
                                         style="object-fit: cover; min-height: 150px;">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="card-body d-flex flex-column h-100">
                                    <!-- Заголовок и избранное -->
                                    <div class="d-flex justify-content-between align-items-start">
                                        <h5 class="card-title fw-bold mb-0">{{ $apartment->name_price }}</h5>
                                        <!-- Кнопка избранного -->
                                        @php
                                            $isFavorite = auth()->user()?->favorites->where('apartment_id', $apartment->id)->first();
                                        @endphp
                                        @if($isFavorite)
                                            <form action="{{ route('favorites.destroy', $isFavorite) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-heart me-1"></i> В избранном
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('favorites.store', $apartment) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-primary">
                                                    <i class="far fa-heart me-1"></i> Добавить
                                                </button>
                                            </form>
                                        @endif
                                    </div>

                                    <!-- Детали апартаментов -->
                                    <p class="card-text text-muted mt-2">
                                        {{ $apartment->type }} • {{ $apartment->room_count }} комнат(а), до {{ $apartment->capacity }} чел.
                                    </p>
                                    <p class="card-text">{{ Str::limit($apartment->descriptions, 100) }}</p>

                                    <!-- Кнопки действий -->
                                    <div class="mt-auto d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="badge bg-success fs-6">₽{{ number_format($apartment->price_per_night, 0, '', ' ') }}/ночь</span>
                                        </div>
                                        <div class="btn-group">
                                            @if(auth()->check())
                                                <button type="button"
                                                        class="btn btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#bookingModal"
                                                        data-apartment-id="{{ $apartment->id }}"
                                                        data-apartment-name="{{ $apartment->name_price }}"
                                                        data-apartment-price="{{ $apartment->price_per_night }}">
                                                    Забронировать
                                                </button>
                                                <button type="button"
                                                        class="btn btn-outline-primary"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#reviews-{{ $apartment->id }}">
                                                    Отзывы ({{ $apartment->reviews->count() }})
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-primary" disabled title="Требуется авторизация">
                                                    Забронировать
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Секция с отзывами -->
                        <div class="collapse" id="reviews-{{ $apartment->id }}">
                            <div class="card-footer bg-light">
                                <h5 class="mb-4">Отзывы об апартаментах "{{ $apartment->name_price }}"</h5>

                                <!-- Форма добавления отзыва -->
                                @auth
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <form action="{{ route('reviews.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="apartment_id" value="{{ $apartment->id }}">
                                                <div class="mb-3">
                                                <textarea class="form-control"
                                                          name="review_text"
                                                          rows="3"
                                                          required
                                                          placeholder="Поделитесь вашим опытом..."></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-paper-plane me-1"></i> Отправить отзыв
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <div class="alert alert-info mb-4">
                                        <a href="{{ route('login') }}" class="alert-link">Авторизуйтесь</a>, чтобы оставить отзыв
                                    </div>
                                @endauth

                                <!-- Список отзывов -->
                                @if($apartment->reviews->isEmpty())
                                    <div class="alert alert-info">
                                        Пока нет отзывов. Станьте первым!
                                    </div>
                                @else
                                    <div class="reviews-list">
                                        @foreach($apartment->reviews as $review)
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                                        <div>
                                                            <h6 class="card-title mb-0">{{ $review->user->username }}</h6>
                                                            <small class="text-muted">
                                                                {{ $review->review_date->format('d.m.Y') }}
                                                            </small>
                                                        </div>
                                                        @if(auth()->id() == $review->user_id)
                                                            <form action="{{ route('reviews.destroy', $review) }}"
                                                                  method="POST"
                                                                  class="delete-review-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                        class="btn btn-sm btn-outline-danger"
                                                                        title="Удалить отзыв">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                    <p class="card-text mb-0">{{ $review->review_text }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Модальное окно бронирования -->
        <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bookingModalLabel">Забронировать: <span id="apartmentName"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Форма без динамического расчёта -->
                        <form action="{{ route('bookings.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="apartment_id" id="apartmentId">

                            <!-- Поля пользователя -->
                            <div class="mb-3">
                                <label for="clientName" class="form-label">Ваше имя</label>
                                <input type="text" class="form-control" name="name"
                                       value="{{ auth()->check() ? auth()->user()->username : '' }}" required>
                            </div>

                            <!-- Телефон -->
                            <div class="mb-3">
                                <label for="phoneNumber" class="form-label">Номер телефона</label>
                                <input type="tel" class="form-control" name="phone"
                                       value="{{ auth()->check() ? auth()->user()->phone : '' }}" required>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email"
                                       value="{{ auth()->check() ? auth()->user()->email : '' }}" required>
                            </div>

                            <!-- Количество гостей -->
                            <div class="mb-3">
                                <label for="guest_count" class="form-label">Количество гостей</label>
                                <input type="number" class="form-control" name="guest_count" min="1" max="5" value="1" required>
                            </div>

                            <!-- Дата заезда -->
                            <div class="mb-3">
                                <label for="check_in_date" class="form-label">Дата заезда</label>
                                <input type="date" class="form-control" name="check_in_date" required>
                            </div>

                            <!-- Дата выезда -->
                            <div class="mb-3">
                                <label for="check_out_date" class="form-label">Дата выезда</label>
                                <input type="date" class="form-control" name="check_out_date" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                <button type="submit" class="btn btn-primary">Отправить заявку</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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

@push('scripts')
    <script>
        // Только минимальный JS — для модального окна
        document.getElementById('bookingModal').addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const apartmentId = button.getAttribute('data-apartment-id');
            const apartmentName = button.getAttribute('data-apartment-name');

            document.getElementById('apartmentId').value = apartmentId;
            document.getElementById('apartmentName').textContent = apartmentName;
        });
    </script>
@endpush
