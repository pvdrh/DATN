<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Transaction;
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

    public function transaction(Request $request)
    {
        $agencyId = $request->input('agency_id');
        $transactions = Transaction::with(['customer', 'service', 'user', 'agency']);

        if ($agencyId) {
            $transactions->where('agency_id', $agencyId);
        }
        $transactions = $transactions->paginate(10);

        $agencies = Agency::all();

        return view('transaction', compact('transactions', 'agencies'));
    }

}
