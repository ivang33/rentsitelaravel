@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h2>Список городов</h2>
                <a href="{{ route('admin.cities.create') }}" class="btn btn-primary">Добавить город</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($cities->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Описание</th>
                                <th>Изображение</th>
                                <th>Дата создания</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cities as $city)
                                <tr>
                                    <td>{{ $city->id }}</td>
                                    <td>{{ $city->city_name }}</td>
                                    <td>{{ Str::limit($city->description, 50) }}</td>
                                    <td>
                                        @if($city->image)
                                            <img src="{{ asset('storage/'.$city->image) }}" alt="{{ $city->city_name }}" style="max-width: 100px;">
                                        @else
                                            Нет изображения
                                        @endif
                                    </td>
                                    <td>{{ $city->created_at->format('d.m.Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.cities.edit', $city->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                                        <form action="{{ route('admin.cities.destroy', $city->id) }}" method="POST" class="d-inline">
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

                    {{ $cities->links() }}
                @else
                    <div class="alert alert-info">
                        Нет добавленных городов. <a href="{{ route('admin.cities.create') }}">Добавить первый город</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
