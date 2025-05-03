@extends('layouts.app')

@section('title', 'Авторизация')

@section('content')
    <section class="login">
        <div class="container">
            <h2>Авторизация</h2>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="user-email" class="form-label">Электронная почта</label>
                    <input id="user-email" type="email" name="email" class="form-control" placeholder="Введите вашу почту" required>
                    @error('email')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="user-password" class="form-label">Пароль</label>
                    <input id="user-password" type="password" name="password" class="form-control" placeholder="Введите ваш пароль" required>
                    @error('password')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input">
                    <label for="remember" class="form-check-label">Запомнить меня</label>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Войти</button>
                </div>
            </form>
        </div>
    </section>
@endsection
