<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function index(): View
    {
        $users = User::all();
        return view('admin', compact('users'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin',
        ]);

        $user->update($request->only('first_name', 'email', 'role'));

        return redirect()->route('admin.users.index')->with('success', 'Usuário atualizado!');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('admin')->with('success', 'Usuário excluído!');
    }
}
