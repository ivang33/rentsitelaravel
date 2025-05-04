<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        // Получаем текущего авторизованного пользователя
        $user = auth()->user();

        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        // Получаем текущего авторизованного пользователя
        $user = auth()->user();

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:255',
            'birthday' => 'nullable|date_format:d.m.Y',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|min:8|confirmed',
            'password_confirmation' => 'nullable|min:8',
        ]);

        // Обработка аватара
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        // Обновление данных пользователя
        $user = auth()->user();
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'birthday' => $request->birthday ? \Carbon\Carbon::createFromFormat('d.m.Y', $request->birthday) : null,
            'avatar' => $avatarPath ?? $user->avatar,
        ]);

        // Если указан пароль, обновляем его
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->route('profile.show')->with('success', 'Профиль успешно обновлен');
    }
}
