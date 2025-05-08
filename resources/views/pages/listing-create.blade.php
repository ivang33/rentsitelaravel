@extends('layouts.app')

@section('title', 'Я сдаю')

@section('content')
    <div class="container py-5">
        <!-- Заголовок -->
        <h1 class="mb-4">Я сдаю</h1>

        <!-- Форма ввода данных -->
        <form action="#" method="POST">
            @csrf

            <!-- Выбор типа жилья -->
            <div class="mb-3">
                <label class="form-label">Выберите тип жилья</label>
                <div class="btn-group btn-group-toggle d-flex flex-wrap" data-bs-toggle="buttons">
                    <input type="radio" class="btn-check" name="property_type" id="hotel" value="hotel">
                    <label class="btn btn-outline-primary w-100 mb-2" for="hotel">Гостиница</label>

                    <input type="radio" class="btn-check" name="property_type" id="apartment" value="apartment">
                    <label class="btn btn-outline-primary w-100 mb-2" for="apartment">Квартира</label>

                    <input type="radio" class="btn-check" name="property_type" id="house" value="house" checked>
                    <label class="btn btn-outline-primary w-100 mb-2 active" for="house">Дом</label>

                    <input type="radio" class="btn-check" name="property_type" id="resort" value="resort">
                    <label class="btn btn-outline-primary w-100 mb-2" for="resort">База отдыха</label>

                    <input type="radio" class="btn-check" name="property_type" id="room" value="room">
                    <label class="btn btn-outline-primary w-100 mb-2" for="room">Комната</label>
                </div>
            </div>

            <!-- Подтип жилья -->
            <div class="mb-3">
                <label class="form-label">Выберите подтип жилья</label>
                <div class="btn-group btn-group-toggle d-flex flex-wrap" data-bs-toggle="buttons">
                    <input type="radio" class="btn-check" name="sub_property_type" id="whole_house" value="whole_house">
                    <label class="btn btn-outline-secondary w-100 mb-2" for="whole_house">Частный дом</label>

                    <input type="radio" class="btn-check" name="sub_property_type" id="cottage" value="cottage">
                    <label class="btn btn-outline-secondary w-100 mb-2" for="cottage">Садовый домик</label>

                    <input type="radio" class="btn-check" name="sub_property_type" id="kottdge" value="kottdge">
                    <label class="btn btn-outline-secondary w-100 mb-2" for="kottdge">Коттедж</label>

                    <input type="radio" class="btn-check" name="sub_property_type" id="other" value="other">
                    <label class="btn btn-outline-secondary w-100 mb-2" for="other">Другое</label>
                </div>
            </div>

            <!-- Город -->
            <div class="mb-3">
                <label for="city" class="form-label">Укажите город</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Страна, город, район, метро" required>
            </div>

            <!-- Валюта -->
            <div class="mb-3">
                <label for="currency" class="form-label">Укажите валюту</label>
                <select class="form-select" id="currency" name="currency" required>
                    <option value="rub">Рубль</option>
                    <option value="usd">Доллар США</option>
                    <option value="eur">Евро</option>
                </select>
            </div>

            <!-- Менеджер каналов -->
            <div class="mb-3">
                <label for="channel_manager" class="form-label">Менеджер каналов по объекту</label>
                <select class="form-select" id="channel_manager" name="channel_manager" required>
                    <option value="">Выберите менеджера каналов</option>
                    <option value="manager1">Менеджер 1</option>
                    <option value="manager2">Менеджер 2</option>
                    <option value="manager3">Менеджер 3</option>
                </select>
            </div>

            <!-- Согласие -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                <label class="form-check-label" for="terms">Я принимаю условия оферты</label>
            </div>

            <!-- Кнопка продолжить -->
            <button type="submit" class="btn btn-danger">Продолжить оформление</button>
        </form>
    </div>
@endsection
