<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rent Site')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Добавляем иконки Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .navbar-brand-custom {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .nav-link-custom {
            font-weight: 500;
            margin: 0 10px;
        }
        .footer-section {
            background-color: #cce6ff; /* Голубой фон */
            padding: 40px 20px;
            border-radius: 20px; /* Закругленные углы */
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap; /* Для адаптации на мобильных */
            gap: 30px; /* Отступы между колонками */
        }

        .footer-column {
            min-width: 250px;
            text-align: left;
        }

        .footer-column h5 {
            font-weight: bold;
            margin-bottom: 10px;
            color: #000;
        }

        .footer-column ul {
            list-style: none;
            padding: 0;
        }

        .footer-column ul li {
            margin-bottom: 5px;
        }

        .footer-column ul li a {
            color: #000;
            text-decoration: none;
            font-size: 14px;
        }

        .footer-column ul li a:hover {
            color: #0d6efd;
        }

        /* Социальные иконки */
        .social-icons {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .social-icons a {
            color: #000;
            font-size: 24px;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: #0d6efd;
        }

        /* QR-код */
        .qr-code {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            object-fit: cover;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .qr-code:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Логотип в футере */
        .footer-logo {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            object-fit: cover;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .footer-logo:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .main-nav-items a {
            color: #000;
            text-decoration: none;
            font-weight: 500;
        }
        .user-avatar {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
        }
        .navbar-brand-custom img {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border-radius: 8px;
        }

        .navbar-brand-custom:hover img {
            transform: scale(1.1);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
<!-- Основная навигация -->
<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <a class="navbar-brand navbar-brand-custom" href="{{ route('home') }}">
            <img src="{{ asset('public/image 2 (1).png') }}" alt="RentSite Logo" width="70" height="70" class="d-inline-block align-text-top me-2">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                @auth
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="{{ route('contacts') }}">Контакты</a>
                    </li>

                    <!-- Аватар пользователя с выпадающим меню -->
                    <li class="nav-item dropdown ms-3">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('public/default_avatar.png') }}"
                                 alt="Аватар"
                                 class="user-avatar">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.show') }}">Профиль</a></li>
                            <li><a class="dropdown-item" href="{{ route('favorites.index') }}">Избранные номера</a></li>
                            <li><a class="dropdown-item" href="{{ route('profile.reviews') }}">Мои отзывы</a></li>
                            <li><a class="dropdown-item" href="{{ route('listings.create') }}">Я сдаю</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Выйти</button>
                                </form>
                            </li>
                        </ul>
                    </li>

                    @if(auth()->user()->role_id == 1)
                        <li class="nav-item ms-3">
                            <a class="nav-link btn btn-outline-dark" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-speedometer2"></i> Админ-панель
                            </a>
                        </li>
                    @endif

                @else
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="{{ route('login') }}">Войти</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="{{ route('register') }}">Зарегистрироваться</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<!-- Подвал -->
<footer class="footer-section">
    <!-- Левая колонка -->
    <img src="{{ asset('public/image 2 (1).png') }}" alt="RentSite Logo" class="footer-logo mb-3">
    <div class="footer-column">


        <h5>О нас</h5>
        <ul>
            <li><a href="#">Шапка</a></li>
            <li><a href="{{ route('contacts') }}">Контакты</a></li>
            <li><a href="#">Политика лояльности</a></li>
        </ul>
    </div>

    <!-- Центральная колонка -->
    <div class="footer-column">
        <h5>Наши соц-сети</h5>
        <div class="social-icons">
            <a href="#"><i class="bi bi-vk"></i></a>
            <a href="#"><i class="bi bi-telegram"></i></a>
            <a href="#"><i class="bi bi-youtube"></i></a>
        </div>
    </div>

    <!-- Правая колонка -->
    <div class="footer-column text-end">
        <img src="{{ asset('public/qr-code 1.png') }}" alt="QR Code" class="qr-code mt-3">
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
