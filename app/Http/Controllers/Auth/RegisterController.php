<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends \App\Http\Controllers\Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'surname' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'patronymic' => 'nullable|string|max:255',
            'birthday' => 'required|date',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20', // Максимальная длина номера телефона
            'password' => 'required|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Максимальный размер 2MB
        ]);

        // Загрузка аватара
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        // Назначаем роль "user" (ID = 3)
        $roleId = 3; // ID роли "user"

        User::create([
            'username' => $request->name, // Используем имя как username
            'surname' => $request->surname,
            'name' => $request->name,
            'patronymic' => $request->patronymic,
            'birthday' => $request->birthday,
            'email' => $request->email,
            'phone' => $request->phone, // Добавляем телефон
            'password' => Hash::make($request->password),
            'avatar' => $avatarPath, // Сохраняем путь к аватару
            'role_id' => $roleId, // Указываем роль "user"
        ]);

        return redirect()->route('login')->with('success', 'Регистрация прошла успешно. Теперь вы можете войти.');
    }
}
