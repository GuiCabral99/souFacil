<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(): RedirectResponse
    {
        return Auth::check()
            ? redirect()->route('clients.index')
            : redirect()->route('login');
    }
}
