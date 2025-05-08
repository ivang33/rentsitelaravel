@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <section class="hero">
        <div class="container text-center">
            <h1>Найдите идеальное жильё для себя</h1>
            <p>Удобные апартаменты и отели по всему миру</p>

            <!-- Поиск -->
            <form action="{{ route('cities.search') }}" method="GET" class="search-form mt-4">
                <div class="row g-3 justify-content-center">
                    <div class="col-md-3">
                        <input type="text" name="city" id="city-input" class="form-control" placeholder="Город" list="city-suggestions" autocomplete="off" required>
                        <datalist id="city-suggestions">
                            @foreach($cities as $city)
                                <option value="{{ $city->city_name }}"></option>
                            @endforeach
                        </datalist>
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="check_in" class="form-control" placeholder="Заезд">
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="check_out" class="form-control" placeholder="Выезд">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">Поиск</button>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </section>

    <!-- Популярные города -->
    <section class="popular-cities mt-5">
        <div class="container">
            <h2>Популярные города</h2>
            <div class="row">
                <!-- В resources/views/home.blade.php -->
                @foreach ($cities as $city)
                    <div class="col-md-3 mb-4">
                        <a href="{{ route('cities.show', $city) }}" class="text-decoration-none">
                            <div class="card h-100">
                                <!-- Изображение города -->
                                @if($city->photo)
                                    <img src="{{ asset('storage/' . $city->photo) }}" class="card-img-top">
                                @else
                                    <img src="{{ asset('images/default-city.jpg') }}" class="card-img-top">
                                @endif

                                <div class="card-body">
                                    <h5 class="card-title">{{ $city->city_name }}</h5>
                                    <p class="card-text">{{ Str::limit($city->description, 50) }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Почему выбирают нас -->
    <section class="why-us mt-5 mb-5">
        <div class="container">
            <h2>Почему выбирают нас?</h2>
            <div class="row">
                <div class="col-md-4">
                    <h4>Широкий выбор</h4>
                    <p>Более 1000 вариантов жилья по всему миру.</p>
                </div>
                <div class="col-md-4">
                    <h4>Лучшие цены</h4>
                    <p>Сравнивайте предложения и выбирайте выгодные варианты.</p>
                </div>
                <div class="col-md-4">
                    <h4>Простота бронирования</h4>
                    <p>Забронируйте жильё за пару кликов без лишней бюрократии.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cities = @json($cities->pluck('city_name')); // Получаем только названия городов

            const cityInput = document.getElementById('city-input');
            const datalist = document.getElementById('city-suggestions');

            if (cityInput && datalist) {
                // Заполняем datalist вариантами городов
                cities.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city;
                    datalist.appendChild(option);
                });

                // Опционально: можно добавить обработчик ввода для динамического поиска
                cityInput.addEventListener('input', function() {
                    // Можно добавить логику для динамической фильтрации
                });
            }
        });
    </script>
@endsection
