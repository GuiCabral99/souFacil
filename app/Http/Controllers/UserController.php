<?php

namespace App\Http\Controllers;

use App\Models\User as UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function showLoginForm() {
        if(Auth::check()) {
            return redirect()->route('clients.index');
        }
        return view('auth');
    }

    function login(Request $req) {
        if(Auth::check()) {
            return redirect()->route('clients.index');
        }
        $validated = $req->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);
        $user = UserModel::where('email', $validated["email"])->first();

        if ($user && Hash::check($validated["password"], $user->password)){
            Auth::login($user);
            return redirect()->route("clients.index");
        } 
        if (!$user || !Hash::check($validated["password"], $user->password)) {
            return back()->withErrors(['email' => 'Credenciais inválidas.']);
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showRegistrationForm()
    {
        if(Auth::check()) {
            return redirect()->route('clients.index');
        }
        return view('user');
    }

    public function register(Request $req)
    {
        if(Auth::check()) {
            return redirect()->route('clients.index');
        }
        
        $validated = $req->validate([
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = UserModel::create([
            "first_name" =>  $validated ["first_name"],
            "email"=> $validated["email"],
            "password"=>bcrypt($validated["password"])]
        );

        Auth::login($user);

        return redirect()->route("clients.index");
    }
}
