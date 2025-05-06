@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <section class="hero">
        <div class="container text-center">
            <h1>Найдите идеальное жильё для себя</h1>
            <p>Удобные апартаменты и отели по всему миру</p>

            <!-- Поиск -->
            <form action="{{ route('apartments.index') }}" method="GET" class="search-form mt-4">
                <div class="row g-3 justify-content-center">
                    <div class="col-md-3">
                        <input type="text" name="city" class="form-control" placeholder="Город">
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="check_in" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="check_out" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">Поиск</button>
                    </div>
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
                                <img src="{{ asset('storage/' . $city->photo) }}" class="card-img-top" alt="{{ $city->city_name }}" style="height: 180px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title text-dark">{{ $city->city_name }}</h5>
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
