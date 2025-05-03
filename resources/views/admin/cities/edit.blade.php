@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h2>Редактировать город: {{ $city->city_name }}</h2>
                @if($city->image)
                    <img src="{{ asset('storage/'.$city->image) }}" alt="{{ $city->city_name }}" class="img-thumbnail mt-2" style="max-width: 200px;">
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.cities.update', $city->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="city_name">Название города *</label>
                        <input type="text" name="city_name" id="city_name"
                               class="form-control @error('city_name') is-invalid @enderror"
                               value="{{ old('city_name', $city->city_name) }}" required>
                        @error('city_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="description">Описание</label>
                        <textarea name="description" id="description"
                                  class="form-control @error('description') is-invalid @enderror"
                                  rows="5">{{ old('description', $city->description) }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="image">Изображение</label>
                        <input type="file" name="image" id="image"
                               class="form-control-file @error('image') is-invalid @enderror">
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Оставьте пустым, чтобы сохранить текущее изображение</small>
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">Обновить</button>
                        <a href="{{ route('admin.cities.index') }}" class="btn btn-secondary">Отмена</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
