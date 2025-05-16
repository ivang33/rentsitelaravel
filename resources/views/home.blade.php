@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <style>
        /* Герой-секция */
        .hero {
            background-image: url("{{ asset('public/image 1.png') }}");
            background-size: cover; /* Устанавливает изображение в размер контейнера */
            background-position: center; /* Центрирует изображение */
            background-repeat: no-repeat; /* Изображение не повторяется */
            padding: 60px 0;
            position: relative; /* Для добавления затемнения (если нужно) */
            border-radius: 50px;
        }

        /* Добавляем затемнение для лучшего чтения текста */
        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        /* Стили для текста и формы, чтобы они были видны поверх затемнения */
        .hero .container {
            position: relative;
            z-index: 2;
            color: white; /* Белый текст для лучшей видимости */
        }

        .search-form .form-control,
        .search-form .btn {
            border-radius: 25px;
            font-size: 1rem;
            height: 50px;
        }

        .search-form input::placeholder {
            color: #999;
        }

        .search-form .btn-primary {
            background-color: #ff9800;
            border: none;
            transition: background-color 0.3s ease;
        }

        .search-form .btn-primary:hover {
            background-color: #e67e22;
        }

        .popular-cities h2 {
            color: #007bff;
        }

        .popular-city-card {
            background-color: #cce6ff;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .popular-city-card:hover {
            transform: translateY(-5px);
        }

        .popular-city-card img {
            object-fit: cover;
            height: 200px;
        }

        .card-title {
            color: #000;
        }

        .arrow-icon {
            color: #007bff;
            font-weight: bold;
        }

        .why-us {
            background-color: #cce6ff;
            padding: 40px 0;
            border-radius: 50px;
        }

        .why-us h2 {
            color: #007bff;
        }

        .why-us-card {
            background-color: white;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            border-radius: 10px;
        }

        .why-us-card i {
            color: #007bff;
            font-size: 24px;
        }

        .alert {
            border-radius: 25px;
        }
    </style>

    <!-- Герой-секция -->
    <section class="hero">
        <div class="container text-center">
            <h1 class="display-4">Найдите идеальное жильё для себя</h1>
            <p class="lead">Удобные апартаменты и отели по всему миру</p>

            <!-- Поиск -->
            <form action="{{ route('cities.search') }}" method="GET" class="search-form mt-4">
                <div class="row g-3 justify-content-center">
                    <div class="col-md-3">
                        <input type="text" name="city" id="city-input" class="form-control" placeholder="Куда поедете?" list="city-suggestions" autocomplete="off" required>
                        <datalist id="city-suggestions">
                            @foreach($cities as $city)
                                <option value="{{ $city->city_name }}"></option>
                            @endforeach
                        </datalist>
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="check_in" class="form-control" placeholder="Заезд" required>
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="check_out" class="form-control" placeholder="Выезд" required>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">Найти дом!</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Популярные города -->
    <section class="popular-cities mt-5">
        <div class="container">
            <h2 class="text-primary mb-4">Популярные города России</h2>
            <div class="row">
                @foreach ($cities as $city)
                    <div class="col-md-4 mb-4">
                        <a href="{{ route('cities.show', $city) }}" class="text-decoration-none">
                            <div class="card popular-city-card h-100">
                                @if($city->photo)
                                    <img src="{{ asset('storage/' . $city->photo) }}" class="card-img-top" alt="{{ $city->city_name }}">
                                @else
                                    <img src="{{ asset('images/default-city.jpg') }}" class="card-img-top" alt="Город">
                                @endif

                                <div class="card-body d-flex flex-column justify-content-between">
                                    <h5 class="card-title">{{ $city->city_name }}</h5>
                                    <p class="card-text">{{ Str::limit($city->description, 50) }}</p>
                                    <div class="d-flex align-items-center">
                                        <span class="arrow-icon"><i class="fas fa-arrow-right"></i></span>
                                    </div>
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
            <h2 class="text-primary text-center mb-4">Почему выбирают нас?</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="card why-us-card">
                        <div class="card-body">
                            <div class="d-flex align-items-start mb-2">
                                <i class="fas fa-sync-alt me-2 mt-1"></i>
                                <div>
                                    <h5>Вы можете отменить бронирование в любое время до 18:00 накануне дня заезда.</h5>
                                    <p class="mt-2 mb-0">Сумма оплаченного лицензионного сбора будет зачислена на ваш внутренний кошелек в виде RentSite рублей.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card why-us-card">
                        <div class="card-body">
                            <div class="d-flex align-items-start mb-2">
                                <i class="fas fa-shield-alt me-2 mt-1"></i>
                                <div>
                                    <h5>За 15 лет через RentSite было забронировано более 20 миллионов ночей.</h5>
                                    <p class="mt-2 mb-0">На RentSite доступно более 500 000 вариантов размещения в 1200 городах по всей России и Абхазии.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    @if($cities->isNotEmpty())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const cities = @json($cities->pluck('city_name')->toArray());

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
                    cityInput.addEventListener('input', function () {
                        // Можно добавить логику для динамической фильтрации
                    });
                }
            });
        </script>
    @endif
@endsection
