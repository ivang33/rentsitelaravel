@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h2>Добавить новые апартаменты</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-8">
                <form action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Основная информация</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name_price">Название тарифа *</label>
                                        <input type="text" name="name_price" id="name_price"
                                               class="form-control @error('name_price') is-invalid @enderror"
                                               value="{{ old('name_price') }}" required>
                                        @error('name_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hotel_id">Отель *</label>
                                        <select name="hotel_id" id="hotel_id"
                                                class="form-control @error('hotel_id') is-invalid @enderror" required>
                                            <option value="">Выберите отель</option>
                                            @foreach($hotels as $hotel)
                                                <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
                                                    {{ $hotel->hotel_name }} <!-- Отображаем название отеля -->
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('hotel_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="room_number">Номер комнаты *</label>
                                        <input type="text" name="room_number" id="room_number"
                                               class="form-control @error('room_number') is-invalid @enderror"
                                               value="{{ old('room_number') }}" required>
                                        @error('room_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="type">Тип апартаментов *</label>
                                        <input type="text" name="type" id="type"
                                               class="form-control @error('type') is-invalid @enderror"
                                               value="{{ old('type') }}" required>
                                        @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="price_per_night">Цена за ночь *</label>
                                        <input type="number" step="0.01" name="price_per_night" id="price_per_night"
                                               class="form-control @error('price_per_night') is-invalid @enderror"
                                               value="{{ old('price_per_night') }}" required>
                                        @error('price_per_night')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="room_count">Количество комнат *</label>
                                        <input type="number" name="room_count" id="room_count"
                                               class="form-control @error('room_count') is-invalid @enderror"
                                               value="{{ old('room_count', 1) }}" min="1" required>
                                        @error('room_count')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="capacity">Вместимость (чел.) *</label>
                                        <input type="number" name="capacity" id="capacity"
                                               class="form-control @error('capacity') is-invalid @enderror"
                                               value="{{ old('capacity', 2) }}" min="1" required>
                                        @error('capacity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="image">Изображение</label>
                                        <input type="file" name="image" id="image"
                                               class="form-control-file @error('image') is-invalid @enderror">
                                        @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Даты заезда/выезда</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="check_in_date">Дата заезда *</label>
                                        <input type="date" name="check_in_date" id="check_in_date"
                                               class="form-control @error('check_in_date') is-invalid @enderror"
                                               value="{{ old('check_in_date') }}" required
                                               min="{{ date('Y-m-d') }}">
                                        @error('check_in_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="check_out_date">Дата выезда *</label>
                                        <input type="date" name="check_out_date" id="check_out_date"
                                               class="form-control @error('check_out_date') is-invalid @enderror"
                                               value="{{ old('check_out_date') }}" required
                                               min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                                        @error('check_out_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Описание</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="description">Основное описание</label>
                                <textarea name="description" id="description"
                                          class="form-control @error('description') is-invalid @enderror"
                                          rows="4">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="descriptions">Дополнительное описание</label>
                                <textarea name="descriptions" id="descriptions"
                                          class="form-control @error('descriptions') is-invalid @enderror"
                                          rows="4">{{ old('descriptions') }}</textarea>
                                @error('descriptions')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="additional_info">Дополнительная информация</label>
                                <textarea name="additional_info" id="additional_info"
                                          class="form-control @error('additional_info') is-invalid @enderror"
                                          rows="4">{{ old('additional_info') }}</textarea>
                                @error('additional_info')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Отмена</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
