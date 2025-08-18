<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    public function create()
    {
        return Inertia::render('Auth/Register');
    }
    //  pour gerer fonciton store
    public function store(Request $request)
    {

        $credentials = $request->validate([
            'name' => 'required|max:255',
            'email' => ['required', 'email', 'max:255', 'lowercase', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);
        // si la validation passe alors
        $user = User::create($credentials);

        // verification email
        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('home');
    }
}
