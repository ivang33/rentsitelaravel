@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
    <section class="register">
        <div class="container">
            <h2>Регистрация</h2>
            <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="user-surname" class="form-label">Фамилия</label>
                    <input id="user-surname" type="text" name="surname" class="form-control" placeholder="Введите вашу фамилию" required>
                    @error('surname')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="user-name" class="form-label">Имя</label>
                    <input id="user-name" type="text" name="name" class="form-control" placeholder="Введите ваше имя" required>
                    @error('name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="user-patronymic" class="form-label">Отчество</label>
                    <input id="user-patronymic" type="text" name="patronymic" class="form-control" placeholder="Введите ваше отчество">
                    @error('patronymic')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="user-birthday" class="form-label">Дата рождения</label>
                    <input id="user-birthday" type="date" name="birthday" class="form-control" required>
                    @error('birthday')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="user-email" class="form-label">Электронная почта</label>
                    <input id="user-email" type="email" name="email" class="form-control" placeholder="Введите вашу почту" required>
                    @error('email')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Телефон</label>
                    <input id="phone" type="text" name="phone" class="form-control" placeholder="Введите ваш телефон">
                    @error('phone')
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
                <div class="mb-3">
                    <label for="user-password-confirmation" class="form-label">Подтверждение пароля</label>
                    <input id="user-password-confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Подтвердите ваш пароль" required>
                </div>
                <div class="mb-3">
                    <label for="avatar" class="form-label">Аватар</label>
                    <input type="file" name="avatar" id="avatar" class="form-control">
                    @error('avatar')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="btn btn-success">Зарегистрироваться</button>
                </div>
            </form>
        </div>
    </section>
@endsection
