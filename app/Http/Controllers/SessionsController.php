<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
    {
        $attributes = request()->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['phone' => $attributes['phone'], 'password' => $attributes['password']])) {
            session()->regenerate();
            return redirect('dashboard');
        } else {
            return back();
        }
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/login');
    }

    public function profile()
    {
        return view('profile');
    }
}
