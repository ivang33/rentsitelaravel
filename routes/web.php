<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Публичные маршруты
|--------------------------------------------------------------------------
*/

// Главная страница
Route::get('/', [HomeController::class, 'index'])->name('home');

// Просмотр апартаментов
Route::resource('apartments', ApartmentController::class)
    ->only(['index', 'show'])
    ->names([
        'index' => 'apartments.index',
        'show' => 'apartments.show'
    ]);

// Аутентификация
Route::middleware('guest')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login');
    });

    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'showRegistrationForm')->name('register');
        Route::post('/register', 'register');
    });
});

// Выход
Route::middleware('auth')->post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Админ-маршруты
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Дашборд
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Управление городами
    Route::resource('cities', CityController::class)
        ->except(['show'])
        ->names([
            'index' => 'cities.index',
            'create' => 'cities.create',
            'store' => 'cities.store',
            'edit' => 'cities.edit',
            'update' => 'cities.update',
            'destroy' => 'cities.destroy'
        ]);

    // Управление отелями
    Route::resource('hotels', HotelController::class)
        ->except(['show'])
        ->names([
            'index' => 'hotels.index',
            'create' => 'hotels.create',
            'store' => 'hotels.store',
            'edit' => 'hotels.edit',
            'update' => 'hotels.update',
            'destroy' => 'hotels.destroy'
        ]);

    // Управление апартаментами
    Route::resource('apartments', ApartmentController::class)
        ->except(['show', 'index'])
        ->names([
            'create' => 'apartments.create',
            'store' => 'apartments.store',
            'edit' => 'apartments.edit',
            'update' => 'apartments.update',
            'destroy' => 'apartments.destroy'
        ]);

    // Дополнительные маршруты
    Route::get('statistics', [DashboardController::class, 'statistics'])
        ->name('statistics');

    Route::get('settings', [DashboardController::class, 'settings'])
        ->name('settings');
});

