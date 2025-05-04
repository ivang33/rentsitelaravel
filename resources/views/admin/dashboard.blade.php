@extends('admin.layouts.app')

@section('title', 'Админ-панель')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="h2">Админ-панель</h1>
                <p class="lead">Добро пожаловать в административную панель сайта.</p>
            </div>
        </div>

        <!-- Статистика -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Города</h5>
                        <p class="card-text display-4">{{ $stats['cities'] }}</p>
                        <a href="{{ route('admin.cities.create') }}" class="btn btn-light">Добавить город</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Отели</h5>
                        <p class="card-text display-4">{{ $stats['hotels'] }}</p>
                        <a href="{{ route('admin.hotels.create') }}" class="btn btn-light">Добавить отель</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Апартаменты</h5>
                        <p class="card-text display-4">{{ $stats['apartments'] }}</p>
                        <a href="{{ route('admin.apartments.create') }}" class="btn btn-light">Добавить апартаменты</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Недавно добавленные города -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Последние добавленные города</h5>
                    </div>
                    <div class="card-body">
                        @if($stats['recentCities']->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Название</th>
                                        <th>Дата добавления</th>
                                        <th>Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($stats['recentCities'] as $city)
                                        <tr>
                                            <td>{{ $city->id }}</td>
                                            <td>{{ $city->city_name }}</td>
                                            <td>{{ $city->created_at->format('d.m.Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('admin.cities.edit', $city->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                                                <form action="{{ route('admin.cities.destroy', $city->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить город?')">Удалить</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">Нет добавленных городов</div>
                            <a href="{{ route('admin.cities.create') }}" class="btn btn-primary">Добавить первый город</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Недавно добавленные отели -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Последние добавленные отели</h5>
                    </div>
                    <div class="card-body">
                        @if($stats['recentHotels']->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Название</th>
                                        <th>Город</th>
                                        <th>Дата добавления</th>
                                        <th>Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($stats['recentHotels'] as $hotel)
                                        <tr>
                                            <td>{{ $hotel->id }}</td>
                                            <td>{{ $hotel->hotel_name }}</td> <!-- Отображаем название отеля -->
                                            <td>{{ $hotel->city->city_name ?? '-' }}</td> <!-- Город -->
                                            <td>{{ $hotel->created_at->format('d.m.Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('admin.hotels.edit', $hotel->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                                                <form action="{{ route('admin.hotels.destroy', $hotel->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить отель?')">Удалить</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">Нет добавленных отелей</div>
                            <a href="{{ route('admin.hotels.create') }}" class="btn btn-primary">Добавить первый отель</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Недавно добавленные апартаменты -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Последние добавленные апартаменты</h5>
                    </div>
                    <div class="card-body">
                        @if($stats['recentApartments']->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Номер</th>
                                        <th>Тип</th>
                                        <th>Цена за ночь</th>
                                        <th>Отель</th>
                                        <th>Дата добавления</th>
                                        <th>Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($stats['recentApartments'] as $apartment)
                                        <tr>
                                            <td>{{ $apartment->id }}</td>
                                            <td>{{ $apartment->room_number }}</td>
                                            <td>{{ $apartment->type }}</td>
                                            <td>{{ number_format($apartment->price_per_night, 2) }} ₽</td>
                                            <td>{{ $apartment->hotel->hotel_name ?? '-' }}</td> <!-- Отображаем название отеля -->
                                            <td>{{ $apartment->created_at->format('d.m.Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('admin.apartments.edit', $apartment->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                                                <form action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить апартаменты?')">Удалить</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">Нет добавленных апартаментов</div>
                            <a href="{{ route('admin.apartments.create') }}" class="btn btn-primary">Добавить первые апартаменты</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
