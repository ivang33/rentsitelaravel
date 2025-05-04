@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h2>Список отелей</h2>
                <a href="{{ route('admin.hotels.create') }}" class="btn btn-primary">Добавить отель</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($hotels->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Город</th>
                                <th>Адрес</th>
                                <th>Звезды</th>
                                <th>Изображение</th>
                                <th>Дата создания</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($hotels as $hotel)
                                <tr>
                                    <td>{{ $hotel->id }}</td>
                                    <td>{{ $hotel->hotel_name }}</td>
                                    <td>{{ $hotel->city->city_name }}</td>
                                    <td>{{ $hotel->address }}</td>
                                    <td>{{ str_repeat('★', $hotel->stars) }}</td>
                                    <td>
                                        @if($hotel->photo)
                                            <img src="{{ asset('storage/'.$hotel->photo) }}" alt="{{ $hotel->hotel_name }}" style="max-width: 100px;">
                                        @else
                                            Нет изображения
                                        @endif
                                    </td>
                                    <td>{{ $hotel->created_at->format('d.m.Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.hotels.edit', $hotel->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                                        <form action="{{ route('admin.hotels.destroy', $hotel->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?')">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $hotels->links() }}
                @else
                    <div class="alert alert-info">
                        Нет добавленных отелей. <a href="{{ route('admin.hotels.create') }}">Добавить первый отель</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
