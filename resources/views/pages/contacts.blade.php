@extends('layouts.app')

@section('title', 'Контакты')

@section('content')
    <div class="container py-5">
        <!-- Навигация -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
                <li class="breadcrumb-item active" aria-current="page">Контакты</li>
            </ol>
        </nav>

        <!-- Заголовок -->
        <h1 class="mb-4">Контакты</h1>
        <p class="lead mb-5">Мы всегда готовы помочь. Пишите не стесняйтесь!</p>

        <!-- Контактная информация -->
        <div class="row">
            <div class="col-md-6">
                <h5>Контакты</h5>
                <ul class="list-unstyled">
                    <li>
                        <i class="fas fa-envelope me-2"></i>
                        Электронная почта: <a href="mailto:ivan.galatsan.01@mail.ru">ivan.galatsan.01@mail.ru</a>
                    </li>
                    <li>
                        <i class="fas fa-map-marker-alt me-2"></i>
                        Адрес для писем: 350015, г. Краснодар, а/я 5060
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <h5>Реквизиты</h5>
                <p>
                    Компания ООО «РЕНТ СОФТ»;<br>
                    ОГРН 1217700160061;<br>
                    ИНН 9731077781;<br>
                    КПП 773101001;<br>
                    р/с 40702810610000794618 в АО «ТБАНК»;<br>
                    БИК 044529574;<br>
                    к/с 3010181045250000974<br>
                    Юридический адрес:<br>
                    121596, г. Москва, муниципальный округ Можайский ВАО, ул. Гребенова, д. 2, стр. 3, помещение 55/6
                </p>
            </div>
        </div>

        <!-- Подвал -->
        <footer class="mt-5 text-center">
            <p class="mb-0">О RENT говорят, RENT доверяют</p>
        </footer>
    </div>
@endsection
