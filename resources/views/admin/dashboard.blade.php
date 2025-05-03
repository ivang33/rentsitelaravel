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
        <div class="row">
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
    </div>
@endsection
