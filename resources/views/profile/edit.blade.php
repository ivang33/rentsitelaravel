@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Редактирование профиля</h1>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Аватар -->
            <div class="mb-3">
                <label for="avatar" class="form-label">Аватар</label>
                <div class="d-flex align-items-center">
                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/default-avatar.png') }}" alt="Аватар" class="img-thumbnail me-3" style="max-width: 100px;">
                    <input type="file" name="avatar" id="avatar" class="form-control">
                </div>
                @error('avatar')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Имя пользователя -->
            <div class="mb-3">
                <label for="username" class="form-label">Имя пользователя *</label>
                <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user->username) }}" required>
                @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email *</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Телефон -->
            <div class="mb-3">
                <label for="phone" class="form-label">Телефон</label>
                <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}">
                @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!-- Дата рождения -->
            <div class="mb-3">
                <label for="birthday" class="form-label">Дата рождения</label>
                <input type="text" name="birthday" id="birthday" class="form-control @error('birthday') is-invalid @enderror" value="{{ \Carbon\Carbon::parse($user->birthday)->format('d.m.Y') }}">
                @error('birthday')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Пароль -->
            <div class="mb-3">
                <label for="password" class="form-label">Новый пароль</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Подтверждение пароля -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Подтвердите пароль</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Обновить профиль</button>
        </form>
    </div>
@endsection
