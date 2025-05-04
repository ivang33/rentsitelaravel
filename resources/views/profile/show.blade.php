<!-- resources/views/profile/show.blade.php -->
@extends('layouts.app')

@section('title', 'Профиль')

@section('content')
    <div class="container">
        <h1>Профиль</h1>

        <!-- Отображение данных профиля -->
        <div class="row">
            <div class="col-md-6">
                <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('public/default_avatar.png') }}"
                alt="Аватар"
                class="rounded-circle"
                width="170"
                height="170"
                style="object-fit: cover;">
            </div>
            <div class="col-md-6">
                <p><strong>Имя пользователя:</strong> {{ $user->username }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Телефон:</strong> {{ $user->phone }}</p>
                <p><strong>Дата рождения:</strong> {{ \Carbon\Carbon::parse($user->birthday)->format('d.m.Y') }}</p>
            </div>
        </div>

        <!-- Кнопка редактирования профиля -->
        <a href="{{ route('profile.edit') }}" class="btn btn-primary mt-3">Редактировать профиль</a>
    </div>
@endsection
