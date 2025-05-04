@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h2>Редактировать отель: {{ $hotel->hotel_name }}</h2>
                @if($hotel->photo)
                    <img src="{{ asset('storage/'.$hotel->photo) }}" alt="{{ $hotel->hotel_name }}" class="img-thumbnail mt-2" style="max-width: 200px;">
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.hotels.update', $hotel->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="hotel_name">Название отеля *</label>
                        <input type="text" name="hotel_name" id="hotel_name"
                               class="form-control @error('hotel_name') is-invalid @enderror"
                               value="{{ old('hotel_name', $hotel->hotel_name) }}" required>
                        @error('hotel_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="city_id">Город *</label>
                        <select name="city_id" id="city_id" class="form-control @error('city_id') is-invalid @enderror" required>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ old('city_id', $hotel->city_id) == $city->id ? 'selected' : '' }}>
                                    {{ $city->city_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('city_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="address">Адрес *</label>
                        <input type="text" name="address" id="address"
                               class="form-control @error('address') is-invalid @enderror"
                               value="{{ old('address', $hotel->address) }}" required>
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="stars">Количество звезд *</label>
                        <select name="stars" id="stars" class="form-control @error('stars') is-invalid @enderror" required>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('stars', $hotel->stars) == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        @error('stars')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="description">Описание</label>
                        <textarea name="description" id="description"
                                  class="form-control @error('description') is-invalid @enderror"
                                  rows="5">{{ old('description', $hotel->description) }}</textarea>
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
                        <a href="{{ route('admin.hotels.index') }}" class="btn btn-secondary">Отмена</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
