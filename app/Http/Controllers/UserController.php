<?php

namespace App\Http\Controllers;

use App\Models\User as UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Validation\Rules\Password;


class UserController extends Controller
{
    public function showLoginForm(): RedirectResponse|View
    {
        return Auth::check()
            ? redirect()->route('clients.index')
            : view('auth');
    }

    public function login(Request $request): RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('clients.index');
        }

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $user = UserModel::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            return redirect()->route('clients.index');
        }

        return back()->withErrors(['email' => 'Credenciais inválidas.']);
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showRegistrationForm(): RedirectResponse|View
    {
        return Auth::check()
            ? redirect()->route('clients.index')
            : view('user');
    }

    public function register(Request $request): RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('clients.index');
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = UserModel::create([
            'first_name' => $validated['first_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect()->route('clients.index');
    }

    public function edit(): View
    {
        return view('user.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return back()->with('status', 'Conta atualizada com sucesso.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);
    
        $user = $request->user();
        $user->password = Hash::make($request->password);
        $user->save();
    
        return back()->with('status', 'Senha atualizada com sucesso!');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $user = $request->user();
        Auth::logout();
        $user->delete();

        return redirect()->route('home')->with('status', 'Conta excluída com sucesso.');
    }
}
