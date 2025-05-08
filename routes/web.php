<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CityController as AdminCityController;
use App\Http\Controllers\Admin\HotelController as AdminHotelController;
use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CityController; // Публичный контроллер
use App\Http\Controllers\HotelController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReviewController;
// === Публичные маршруты ===

// Главная страница
Route::get('/', [HomeController::class, 'index'])->name('home');

// Страница города с отелями (Публичная)
Route::get('/cities/{city}', [CityController::class, 'show'])->name('cities.show');
Route::get('/cities/{city}/sort-by-price', [CityController::class, 'sortByPrice'])->name('cities.sort_by_price');
Route::get('/cities/{city}/sort-by-rating', [CityController::class, 'sortByRating'])->name('cities.sort_by_rating');

Route::get('/search', [CityController::class, 'search'])->name('cities.search');

Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/{apartment}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{favorite}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
});
Route::post('/bookings', [BookingController::class, 'store'])
    ->name('bookings.store')
    ->middleware('auth');
// Просмотр апартаментов
Route::resource('apartments', ApartmentController::class)
    ->only(['index', 'show'])
    ->names([
        'index' => 'apartments.index',
        'show' => 'apartments.show'
    ]);
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
Route::get('/profile/reviews', [ReviewController::class, 'myReviews'])->name('profile.reviews');
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
// Страница контактов
Route::get('/contacts', function () {
    return view('pages.contacts');
})->name('contacts');

// Страница "Я сдаю"
Route::get('/listings/create', function () {
    return view('pages.listing-create');
})->name('listings.create');
// Выход
Route::middleware('auth')->post('/logout', [LoginController::class, 'logout'])->name('logout');

// Профиль пользователя
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

/*
|--------------------------------------------------------------------------
| Админ-маршруты
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Дашборд
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Управление городами (через Admin\CityController)
    Route::resource('cities', AdminCityController::class)
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
    Route::resource('hotels', AdminHotelController::class)
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
    Route::get('statistics', [DashboardController::class, 'statistics'])->name('statistics');
    Route::get('settings', [DashboardController::class, 'settings'])->name('settings');
});
